<?php

class Database
{
    private $config;

    public $pdo;

    public function __construct()
    {
        $this->config = Config::$database;
    }
}
