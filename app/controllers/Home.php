<?php
class Home extends Controller
{
    public function __construct()
    {
        $this->index();
    }

    public function index()
    {
        $this->loadView('welcome_view');
        if(Session::GetSessionVariable("isLogged") == true){
          $this->loadView('user_view');
        }else {
          $this->loadView('login_view');
        }

    }
}
