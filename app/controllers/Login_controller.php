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
      $this->helper->redirect('/', false);
    }

    public function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if ($this->modelFunction('User_model', 'login', [$login,$password])) {
            $this->session->addSessionVariable('isLogged', true);
            $this->helper->redirect('/', false);
        } else {
            $this->session->addSessionVariable('isLogged', false);
              $this->helper->redirect('/', false);
        }
    }
}
