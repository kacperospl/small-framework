<?php


class Model
{
    public $database;

    public function __construct()
    {
      $this->_setupDatabaseConnection();
    }

    private function _setupDatabaseConnection(){
      try {
          $this->database = new PDO('mysql:host='.Config::$database['host'].';dbname='.Config::$database['db_name'].'', Config::$database['username'], Config::$database['password']);
      } catch (PDOException $exception) {
          ErrorHandler::Error('Cannot connect to database: ' . $exception->getMessage());
      }
    }
}
