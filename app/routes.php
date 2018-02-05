<?php

class Routes
{
    public function setup_routes($router)
    {
        $router->respond('GET', '/hello-world', function () {
            return 'Hello World!';
        });

        $router->respond('GET', '/', function () {
            $home = new Home();
        });
    }
}
