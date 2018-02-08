<?php

  //How to use:
  // ex: Config::$database['username']

  namespace App;

class Config
{
    public  $other = array(
        'error_reporting' => true
      );

    public  $database = array(
      'host' => '127.0.0.1',
      'port' => '3307',
      'password' => 'root123',
      'db_name' => 'sframework',
      'username' => 'root'
    );

    public  $resources = array(
      'css' => DOC_ROOT.'/public/resources/css/',
      'js' => DOC_ROOT.'/public/resources/js/'
    );

    public  $classLoaderPaths = array(
        DOC_ROOT.'/app/controllers/',
        DOC_ROOT.'/app/models/'
    );

    public  $session = array(
        'session_name' => 'framework_variables'
      );
}
