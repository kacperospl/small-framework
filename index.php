<?php

namespace Framework;

require_once 'vendor/autoload.php';

$root = getCWD();

require_once $root. '/framework_core/init.php';


$app = new Application();
Utills\Session::StartSession();

$app->router->dispatch();
