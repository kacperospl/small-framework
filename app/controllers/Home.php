<?php
namespace App\Controllers;

class Home extends \Framework\Core\Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->index();
    }

    public function index()
    {
        $this->view->loadView('welcome_view', array());

        if ($this->session->getSessionVariable("isLogged") == true) {
            $this->view->loadView('user_view', array('name'=> "kacper"));
        } else {
            $this->view->loadView('login_view', array());
        }
    }
}
