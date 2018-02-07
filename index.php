<?php

namespace Framework;

require_once 'vendor/autoload.php';

$root = getCWD();

require_once $root. '/framework_core/init.php';


$app = new Application();

$session = new \Framework\Utills\Session();
$session->startSession();

$app->router->dispatch();
