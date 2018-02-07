<?php

  namespace Framework\Utills;

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


    public function execute($statement, $args)
    {
    }
}
