<?php

namespace Framework;

class Application
{
    public $router;


    public function __construct()
    {
        $this->router = new  \Klein\Klein();
        $this->_setupRoutes();
        $this->_handleErrorCodes();
    }

    private function _setupRoutes()
    {
        require_once DOC_ROOT. '/app/routes.php';
    }



    private function _handleErrorCodes()
    {
        $this->router->onHttpError(function ($code, $router) {
            include_once 'html_templates/http_error.php';
        });
    }
}
