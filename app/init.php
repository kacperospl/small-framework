<?php


define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once 'app/core/Loader.php';




require_once 'app/core/Controller.php';
require_once 'app/core/Model.php';


require_once 'app/routes.php';
require_once 'app/core/Application.php';

$autoload = new Loader();


 ?>
