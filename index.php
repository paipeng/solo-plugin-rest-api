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

include_once '../core/database/db.helpers.class.php';


include_once APP_ROUTE . 'models/user.php';
include_once APP_ROUTE . 'models/project.php';
include_once APP_ROUTE . 'models/client.php';
include_once APP_ROUTE . 'models/activity.php';
include_once APP_ROUTE . 'models/message.php';
include_once APP_ROUTE . 'models/projectnotes.php';
include_once APP_ROUTE . 'models/timeentry.php';
include_once APP_ROUTE . 'models/activitymanager.php';

include_once APP_ROUTE . 'models/file.php';
include_once APP_ROUTE . 'models/task.php';


include_once 'SoloModels/SoloClient.php';

include_once 'functions.php';
include_once "api/HomeApi.php";
include_once 'api/ProjectApi.php';
include_once 'api/ClientApi.php';
include_once 'api/TaskApi.php';

setTimezone();

Epi::setPath('base', LIB_PATH);

Epi::setSetting('exceptions', true);
Epi::init('route', 'api');

initApi(getApi());
initRoute(getRoute());

?>
