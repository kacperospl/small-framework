<?php

  //How to use:
  // ex: Config::$database['username']

  class Config
  {
      public static $other = array(
        'error_reporting' => true
      );

      public static $database = array(
      'host' => '127.0.0.1',
      'port' => '3307',
      'password' => 'root123',
      'db_name' => 'sframework',
      'username' => 'root'
    );

      public static $resources = array(
      'css' => DOC_ROOT.'/public/resources/css/',
      'js' => DOC_ROOT.'/public/resources/js/'
    );

      public static $classLoaderPaths = array(
        DOC_ROOT.'/app/controllers/',
        DOC_ROOT.'/app/models/'
    );

      public static $session = array(
        'session_name' => 'framework_variables'
      );
  }
