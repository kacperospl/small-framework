<?php



require_once 'vendor/autoload.php';

$root = getCWD();

require_once $root. '/app/init.php';


$app = new Application();


$app->router->dispatch();


 ?>
