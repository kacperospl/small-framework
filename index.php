<?php

namespace Framework;
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);

$START_TIME = microtime(true);

require_once 'vendor/autoload.php';




$app = new Application();

$session = new \Framework\Utills\Session();
$session->startSession();

$app->router->dispatch();

$END_TIME = microtime(true);

$benchmark = $END_TIME - $START_TIME;

printDebug($benchmark);



function printDebug($benchmark)
{
    $config = new \App\Config();
    if ($config->other['benchmark']) {
        echo '
      <style>
        .BenchmarkRes {
          position:absolute;
          top:0;
          left:0;
          color:white;
          ';

        if ($benchmark>1) {
            echo 'background-color:red;';
        } else {
            echo 'background-color:blue;';
        }
        echo '
        }
      </style>
      <div class="BenchmarkRes">
      <p> '.$benchmark.' </p>
      <p>
    ';
      print_r($_POST);
      print_r($_GET);
      echo '</p>';
      echo '</div>';
    }
}
