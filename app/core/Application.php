<?php

class Application
{
    public $router;
    public static $config;
    public function __construct()
    {
        $this->router = new \Klein\Klein();
        $this->setup_routes();
    }

    private function setup_routes()
    {
        $routes = new Routes();
        $routes->setup_routes($this->router);
    }

    public function dispatch()
    {
        $this->router->dispatch();
    }

    public function add_Controller($name, $controller)
    {
        $controller_file = DOC_ROOT. '/app/controllers/'.$controller.'.php';
        require_once $controller_file;


        $this->klein->respond('GET', '/'.$name, function () {
            return 'lel';
        });
    }
}
