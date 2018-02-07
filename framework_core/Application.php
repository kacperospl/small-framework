<?php

class Application
{
    public $router;


    public function __construct()
    {
        $this->router = new  \Klein\Klein();
        $this->_setupRoutes();
    }

    private function _setupRoutes()
    {
        $routeList = new Routes();
        $routeList->setup_routes($this->router);
    }
}
