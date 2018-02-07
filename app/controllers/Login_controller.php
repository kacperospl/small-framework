<?php
namespace App\Controllers;

class Login_controller extends \Framework\Core\Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    }

    public function logout()
    {
        $this->session->deleteSessionVariable('isLogged');
        \Framework\Utills\Helper::Redirect('/', false);
    }

    public function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if ($this->modelFunction('User_model', 'login', [$login,$password])) {
            $this->session->addSessionVariable('isLogged', true);
            \Framework\Utills\Helper::Redirect('/', false);
        } else {
            $this->session->addSessionVariable('isLogged', false);
            \Framework\Utills\Helper::Redirect('/', false);
        }
    }
}
