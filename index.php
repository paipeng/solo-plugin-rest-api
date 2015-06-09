<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__).'../../');
define('APP_ROUTE', ROOT . '/application');

require_once ('../../config/config.php');

include_once '../libraries/epiphany/src/Epi.php';
include_once '../../core/app.class.php';
include_once '../../core/database.class.php';
include_once '../../core/auth.class.php';
include_once '../../core/controller.class.php';
include_once '../../core/shared.functions.php';
include_once '../../core/utils.class.php';
include_once '../../core/model.class.php';

include_once '../../application/models/user.php';
include_once '../../application/models/project.php';

Epi::setPath('base', '../libraries/epiphany/src');

Epi::setSetting('exceptions', true);
Epi::init('route', 'api');



getRoute()->get('/', 'home');
getRoute()->get('/contact', 'contactUs');
getRoute()->get('/login', 'auth', EpiApi::external);
getRoute()->get('/logout', 'logout', EpiApi::external);
getRoute()->get('/projects', 'getProjects', EpiApi::external);
getRoute()->get('/version', 'apiVersion', EpiApi::external);


getApi()->get('/params.json', 'apiParams', EpiApi::external);


getRoute()->run();

function home() {
    echo 'Solo Rest API';
}

function apiParams()
{
  return $_GET;
}

function contactUs() {
    echo 'Send us an email at <a href="mailto:foo@bar.com">foo@bar.com</a>';
}

function auth() {
    $user = getApi()->invoke('/params.json', EpiRoute::httpGet);
    //echo "username " . $user["username"];
    $auth = new Auth();
    if ($auth->login($user["username"], $user["password"])) {
        return array('result' => '200 OK');
    } else {
        return array('result' => "error");
    }
}

function logout() {
    $auth = new Auth();
    $auth->logout();
    return array('result' => "200 OK");
}

function getProjects() {
    $auth = new Auth();

    //$auth->logout();
    if ($auth->logged_in()) {
    $project = new Project();
    $v = $project->get();
    return $v;
    } else {
        echo "error";
    }
}

function apiVersion()
{
  return array('version' => '1.0');
}
?>
