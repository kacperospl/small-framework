<?php

class Controller
{
  protected $models = array();





protected function add_model($name,$model)
{
$this->$models[$name] = $model;
}

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
