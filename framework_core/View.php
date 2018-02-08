<?php
  namespace Framework\Core;

class View
{
    public function __construct()
    {
    }

    public function loadView($name, array $data)
    {
        $view_path = DOC_ROOT . '/app/views/'.$name.'.php';

        if (file_exists($view_path)) {
            include_once $view_path;
        } else {
            \Framework\Utills\ErrorHandler::Error("View: ".$name.".php doesnt exists!");
        }
    }
}
