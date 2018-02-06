<?php

class Routes
{
    public function setup_routes($router)
    {
        $router->respond('GET', '/', function () {
            $home = new Home();
        });

        $router->respond('POST', '/login', function ($request, $response) {
            $login = new Login_controller();
            $login->login();
        });

        $router->respond('GET', '/logout', function ($request, $response) {
            $login = new Login_controller();
            $login->logout();
        });
    }
}
