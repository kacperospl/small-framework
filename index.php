<?php



require_once 'vendor/autoload.php';

$root = getCWD();

require_once $root. '/framework_core/init.php';


$app = new Application();
Session::StartSession();

$app->router->dispatch();
