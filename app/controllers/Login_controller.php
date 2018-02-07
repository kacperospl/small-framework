<?php
namespace App\Controllers;
class Login_controller extends \Framework\Core\Controller
{
    public function index()
    {
    }

    public function logout()
    {
        \Framework\Utills\Session::DeleteSessionVariable('isLogged');
        \Framework\Utills\Helper::Redirect('/', false);
    }

    public function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if ($this->modelFunction('User_model', 'login', [$login,$password])) {
              \Framework\Utills\Session::AddSessionVariable('isLogged', true);
              \Framework\Utills\Helper::Redirect('/', false);
        } else {
              \Framework\Utills\Session::AddSessionVariable('isLogged', false);
              \Framework\Utills\Helper::Redirect('/', false);
        }
    }
}
