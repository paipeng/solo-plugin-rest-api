<?php
/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 12/06/15
 * Time: 00:32
 */

function initRoute($route) {
    $route->get('/', array('HomeApi', 'getHome'), EpiApi::external);

getApi()->get('/getParams.json', 'apiGetParams', EpiApi::external);
getApi()->get('/postParams.json', 'apiPostParams', EpiApi::external);
getApi()->get('/httpBody.json', 'apiHttpBody', EpiApi::external);

    $route_config = getConfig();

    foreach ($route_config->routes as $apiname) {
        $routes = $apiname->route;
        foreach ($routes as $api_route) {
            $method = strtolower($api_route->method);
            $route->$method($api_route->path,
                (property_exists($api_route, 'class')?array($api_route->class, $api_route->function):$api_route->function),
                $api_route->external);
        }
    }
    $route->run();
}

function getConfig() {
    $str = file_get_contents('route.json');
    $json = json_decode($str);
    //var_dump($json);
    return $json;
}

function isLoggedIn()
{
    $auth = new Auth();
    return $auth->logged_in();
}

function isStatusOnSchedule($result)
{
    return (array_key_exists('status_text', $result) && $result['status_text'] == 'on-schedule' && !isset($result['id']));
}

function apiGetParams()
{
    return $_GET;
}

function apiPostParams()
{
    return $_POST;
}

function apiHttpBody() {
    $entityBody = file_get_contents('php://input');
    //var_dump($entityBody);
    return (array)json_decode($entityBody);
}

function showApis() {
    $route_config = getConfig();

    echo "<table>";
    echo "<tr><th>Method</th><th>Path</th></tr>";
    foreach ($route_config->routes as $apiname) {
        echo "<tr><td><h1>". $apiname->api. "</h1></td></tr>";
        foreach ($apiname->route as $route) {
        echo "<tr><td>" . $route->method. "</td><td><a href='.".$route->path."'>" . $route->path . "</a></td></tr>";
        }
    }
    echo "</table>";
}

function setTimezone() {
    //$systemTimeZone = system('date +%Z');

    date_default_timezone_set('UTC');
}
