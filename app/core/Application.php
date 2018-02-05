<?php

class Application
{
    public $router;

    public static $config;

    public function __construct()
    {
        $this->router = new \Buki\Router();
        $this->_setupRoutes();

    }

    private function _setupRoutes()
    {
        $routeList = new Routes();
        $routeList->setup_routes($this->router);

    }

}
