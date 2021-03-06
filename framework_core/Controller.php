<?php

namespace Framework\Core;

abstract class Controller
{
    protected $session;
    protected $helper;
    protected $validator;
    protected $view;
    public function __construct()
    {
        $this->session = new \Framework\Utills\Session();
        $this->helper = new \Framework\Utills\Helper();
        $this->view = new View();
        $this->validator = new \Framework\Utills\Validator();
    }

    abstract public function index();


    //getting model
    //eg   $test_model = $this->model('test_model');
    protected function model($name)
    {
        $model_path = DOC_ROOT . '/app/models/'.$name.'.php';

        if (file_exists($model_path)) {
            require_once $model_path;
            $namespaced = "\App\Models\\".$name;
            return new $namespaced();
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
}
