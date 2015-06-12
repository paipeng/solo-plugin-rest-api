<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__).'/../');
define('APP_ROUTE', ROOT . 'application/');

define('LIB_PATH', '../application/libraries/epiphany/src/');

require_once ('../config/config.php');

include_once LIB_PATH . 'Epi.php';

include_once '../core/app.class.php';
include_once '../core/database.class.php';
include_once '../core/auth.class.php';
include_once '../core/controller.class.php';
include_once '../core/shared.functions.php';
include_once '../core/utils.class.php';
include_once '../core/model.class.php';
include_once '../core/language.class.php';
include_once '../core/validator.class.php';

include_once APP_ROUTE . 'models/user.php';
include_once APP_ROUTE . 'models/project.php';
include_once APP_ROUTE . 'models/task.php';


include_once 'functions.php';
include_once "HomeApi.php";
include_once 'ProjectApi.php';

Epi::setPath('base', LIB_PATH);

Epi::setSetting('exceptions', true);
Epi::init('route', 'api');
Epi::setPath('config', dirname(__FILE__));
getRoute()->load('routes.ini');

/*
getRoute()->get('/', array('HomeApi', 'getHome'), EpiApi::external);
getRoute()->get('/contact', 'contactUs');
getRoute()->get('/login', 'auth', EpiApi::external);
getRoute()->get('/logout', 'logout', EpiApi::external);
//getRoute()->get('/projects', 'getProjects', EpiApi::external);
getRoute()->get('/projects', array('ProjectApi', 'getAllProjects'), EpiApi::external);
getRoute()->get('/project/(\d+)', array('ProjectApi', 'getProjectById'), EpiApi::external);
getRoute()->get('/version', array('HomeApi', 'getVersion'), EpiApi::external);
*/

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
