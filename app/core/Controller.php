<?php

class Controller
{




protected function load_view($name)
{
  $view_path = DOC_ROOT . '/app/views/'.$name.'.php';

    include_once $view_path;


}

}


 ?>
