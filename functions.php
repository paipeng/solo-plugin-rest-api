<?php
/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 12/06/15
 * Time: 00:32
 */

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

function showApis() {
    $route_config = getConfig();

    echo "<table>";
    echo "<tr><th>Method</th><th>Path</th></tr>";
    foreach ($route_config->routes as $route) {
        echo "<tr><td>" . $route->method. "</td><td><a href='.".$route->path."'>" . $route->path . "</a></td></tr>";
    }
    echo "</table>";
}
