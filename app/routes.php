<?php

class Routes
{
    public function setup_routes($router)
    {


        $router->respond('GET', '/', function () {
           $home = new Home();
        });

        $router->respond('GET', '/login', function ($request,$response) {

        return $request->validate();


        });



    }
}
