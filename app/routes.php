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

  $router->respond('GET', '/args/[:arg1]/[:arg2]', function ($request)
  {
      return $request->arg1 ."  arg2  ".$request->arg2;

  });


}






}



 ?>
