<?php

class Routes
{
    public function setup_routes($router)
    {

      $router->get('/', function() {
        $home = new Home();
    });

    $router->get('/login', function() {
      $login = new Login_controller();
      $login->login();
  });

  $router->get('/test', function() {
    return 'eehhe';
});

    }
}
