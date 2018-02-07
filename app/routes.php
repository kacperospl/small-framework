<?php


        $this->router->respond('GET', '/', function () {
            $home = new Home();
        });

          $this->router->respond('POST', '/login', function ($request, $response) {
              $login = new Login_controller();
              $login->login();
          });

          $this->router->respond('GET', '/logout', function ($request, $response) {
              $login = new Login_controller();
              $login->logout();
          });
