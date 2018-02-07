<?php

namespace Framework\Core;

use App\Config as Config;

class Model
{
    public $database;

    public function __construct()
    {
        try {
            $this->database = new \PDO('mysql:host='.Config::$database['host'].';port='.Config::$database['port'].';dbname='.Config::$database['db_name'].'', Config::$database['username'], Config::$database['password']);
        } catch (PDOException $exception) {
            ErrorHandler::Error('Cannot connect to database: ' . $exception->getMessage());
        }
    }
}
