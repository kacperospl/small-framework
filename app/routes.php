<?php

class Routes {


public function setup_routes($router)
{

  $router->respond('GET', '/test', function ()
  {
      return 'test';
  });

  $router->respond('GET', '/', function ()
  {
      $home = new Home();

  });


}






}



 ?>
