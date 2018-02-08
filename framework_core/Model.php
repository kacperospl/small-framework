<?php

namespace Framework\Core;

use App\Config as Config;

class Model
{
    public $database;

    public function __construct()
    {
        $config = new \App\Config();
        try {
            $this->database = new \PDO(
                'mysql:host='.$config->database['host'].';
            port='.$config->database['port'].';
            dbname='.$config->database['db_name'].'',
                $config->database['username'],
             $config->database['password']
            );
        } catch (PDOException $exception) {
            ErrorHandler::Error('Cannot connect to database: ' . $exception->getMessage());
        }
    }
}
