<?php

class Login_controller extends Controller
{
    public function index()
    {
    }

    public function logout()
    {
        Session::DeleteSessionVariable('isLogged');
        Helper::Redirect('/', false);
    }

    public function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if ($this->modelFunction('User_model', 'login', [$login,$password])) {
            Session::AddSessionVariable('isLogged', true);
            Helper::Redirect('/', false);
        } else {
            Session::AddSessionVariable('isLogged', false);
            Helper::Redirect('/', false);
        }
    }
}
