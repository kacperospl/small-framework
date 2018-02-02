<?php

class Controller
{




protected function load_view($name)
{
  $view_path = DOC_ROOT . '/app/views/'.$name.'.php';

  if(file_exists($view_path)){
      include_once $view_path;
  } else {
    die('view '.  $name.'.php doesnt exists!' );
  }


}

}


 ?>
