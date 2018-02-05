<?php

class Routes
{
    public function setup_routes($router)
    {

      $router->get('/', function() {
        $home = new Home();
    });


    }
}
