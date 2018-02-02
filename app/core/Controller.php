<?php

class Controller
{


protected function model($name){
  $model_path = DOC_ROOT . '/app/models/'.$name.'.php';

  if(file_exists($model_path)){
      include_once $model_path;
      return new $name();
  } else {
    die('model '.  $name.'.php doesnt exists!' );
    ErrorHandler::error("Model: ".$name.".php doesnt exists!");
  }

}

protected function load_view($name)
{
  $view_path = DOC_ROOT . '/app/views/'.$name.'.php';

  if(file_exists($view_path)){
      include_once $view_path;
  } else {
    ErrorHandler::error("View: ".$name.".php doesnt exists!");
  }


}

}


 ?>
