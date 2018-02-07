<?php

class Application
{
    public $router;


    public function __construct()
    {
        $this->router = new  \Klein\Klein();
        $this->_setupRoutes();
        $this->HandleErrorCodes();
    }

    private function _setupRoutes()
    {
        $routeList = new Routes();
        $routeList->setup_routes($this->router);
    }

    private function HandleErrorCodes()
    {
        $this->router->onHttpError(function ($code, $router) {
            include_once 'html_templates/http_error.php';

        });
    }
}
