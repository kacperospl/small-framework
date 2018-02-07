<?php
namespace App\Controllers;
class Home extends \Framework\Core\Controller
{
    public function __construct()
    {
        $this->index();
    }

    public function index()
    {
        $this->loadView('welcome_view');
        if (\Framework\Utills\Session::GetSessionVariable("isLogged") == true) {
            $this->loadView('user_view');
        } else {
            $this->loadView('login_view');
        }
    }
}
