<?php

abstract class Controller
{
    abstract public function index();


    //getting model
    //eg   $test_model = $this->model('test_model');
    protected function model($name)
    {
        $model_path = DOC_ROOT . '/app/models/'.$name.'.php';

        if (file_exists($model_path)) {
            include_once $model_path;
            return new $name();
        } else {
            ErrorHandler::Error("Model: ".$name.".php doesnt exists!");
        }
    }

    //use method of model
    //eg without params: $this->modelFunction('test_model', 'test', array());
    //eg with params: $this->modelFunction('test_model', 'argtest', array('arguments'));
    protected function modelFunction($name, $function, $args)
    {
        $tmp_model = $this->model($name);
        if (method_exists($tmp_model, $function)) {
            return call_user_func_array(array($tmp_model, $function), $args);
        }
    }

    //loading view
    //eg   $this->load_view('test_view');
    protected function loadView($name)
    {
        $view_path = DOC_ROOT . '/app/views/'.$name.'.php';

        if (file_exists($view_path)) {
            include_once $view_path;
        } else {
            ErrorHandler::Error("View: ".$name.".php doesnt exists!");
        }
    }
}
