<?php

  class Database
  {
      private $_connection;


      public function __construct()
      {
          try {
              $this->_connection = new PDO('mysql:host='.Config::$database['host'].';port='.Config::$database['port'].';dbname='.Config::$database['db_name'].'', Config::$database['username'], Config::$database['password']);
          } catch (PDOException $exception) {
              ErrorHandler::Error('Cannot connect to database: ' . $exception->getMessage());
          }
      }

      //executes INSERT,DELETE,UPDATE etc
      // eg execute('INSERT INTO eg (arg1) VALUES (?)', ['arg1']);
      public function execute($statement, $args)
      {
          $this->_connection->prepare($statement)->execute($args);
      }

      //runs queries
      //eg: query('SELECT * FROM `newsletter`');
      public function query($statement)
      {
          return $this->_connection->query($statement);
      }
  }
