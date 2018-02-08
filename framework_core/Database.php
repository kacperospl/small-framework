<?php

  namespace Framework\Utills;

class Database
{
    private $_connection;
    private $config;

    public function __construct()
    {
      $this->config = new \App\Config();
        try {
            $this->_connection = new PDO('mysql:host='.$this->config->database['host'].';port='.$this->config->database['port'].';dbname='.$this->config->database['db_name'].'', $this->config->database['username'], $this->config->database['password']);
        } catch (PDOException $exception) {
            ErrorHandler::Error('Cannot connect to database: ' . $exception->getMessage());
        }
    }


    public function execute($statement, $args)
    {
    }
}
