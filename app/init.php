<?php


define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);




require_once 'app/config.php';
require_once 'app/core/ClassLoader.php';
require_once 'app/core/Database.php';


require_once 'app/core/ErrorHandler.php';
require_once 'app/core/Controller.php';

require_once 'app/core/Model.php';


require_once 'app/routes.php';
require_once 'app/core/Application.php';

$autoload = new ClassLoader();
