<?php

namespace Framework;

class Application
{
    public $router;


    public function __construct()
    {
        $this->router = new  \Klein\Klein();
        require_once DOC_ROOT. '/app/routes.php';
        $this->HandleErrorCodes();
    }



    private function HandleErrorCodes()
    {
        $this->router->onHttpError(function ($code, $router) {
            include_once 'html_templates/http_error.php';
        });
    }
}
