<?php

namespace Framework;

  $START_TIME = microtime(TRUE);

require_once 'vendor/autoload.php';

$root = getCWD();

require_once $root. '/framework_core/init.php';


$app = new Application();

$session = new \Framework\Utills\Session();
$session->startSession();

$app->router->dispatch();

$END_TIME = microtime(TRUE);

$benchmark = $END_TIME - $START_TIME;
$config = new \App\Config();
if($config->other['benchmark']){
  echo '
    <style>
      .BenchmarkRes {
        position:absolute;
        top:0;
        left:0;
        background-color:blue;
      }
    </style>
    <p class="BenchmarkRes"> '.$benchmark.' </p>
  ';
}
