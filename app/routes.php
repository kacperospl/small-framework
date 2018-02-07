<?php
        namespace App;

$this->router->respond('GET', '/', function () {
    $home = new Controllers\Home();
});

          $this->router->respond('POST', '/login', function ($request, $response) {
              $login = new Controllers\Login_controller();
              $login->login();
          });

          $this->router->respond('GET', '/logout', function ($request, $response) {
              $login = new Controllers\Login_controller();
              $login->logout();
          });
