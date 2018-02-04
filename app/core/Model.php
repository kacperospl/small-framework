<?php


class Model
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}
