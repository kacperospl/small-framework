<?php

  //How to use:
  // ex: Config::$database['username']

  class Config
  {
      public static $database = array(
      'host' => 'localhost',
      'password' => '',
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


  }
