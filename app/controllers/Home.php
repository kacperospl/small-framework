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
        $this->loadView('login_view');
    }


}
