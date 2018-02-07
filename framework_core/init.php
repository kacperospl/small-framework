<?php


define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);




require_once DOC_ROOT . '/app/config.php';
require_once 'Helper.php';
require_once 'ClassLoader.php';
require_once 'Database.php';
require_once 'Session.php';


require_once 'ErrorHandler.php';
require_once 'Controller.php';

require_once 'Model.php';


require_once 'Application.php';

$autoload = new ClassLoader();
