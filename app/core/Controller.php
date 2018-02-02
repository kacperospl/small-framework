<?php

class Controller
{



protected function model($name){
  $model_path = DOC_ROOT . '/app/models/'.$name.'.php';

  if(file_exists($model_path)){
      include_once $model_path;
      return new $name();
  } else {
    ErrorHandler::error("Model: ".$name.".php doesnt exists!");
  }

}


protected function modelFunction($name,$function,$args)
{
    $tmp_model = $this->model($name);
    call_user_func_array(array($tmp_model, $function), $args);
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
