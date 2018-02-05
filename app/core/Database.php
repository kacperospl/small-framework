<?php

  class Database
  {
      private $_connection;


      public function __construct()
      {
          try {
              $this->_connection = new PDO('mysql:host='.Config::$database['host'].';dbname='.Config::$database['db_name'].'', Config::$database['username'], Config::$database['password']);
          } catch (PDOException $exception) {
              ErrorHandler::Error('Cannot connect to database: ' . $exception->getMessage());
          }
      }

      public function execute($statement,$args)
      {

       $this->_connection->prepare($statement)->execute($args);
      }

      public function query($statement)
      {
        return $this->_connection->query($statement);
      }
  }
