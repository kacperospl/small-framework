<?php
class Home extends Controller
{
    public function __construct()
    {
        $this->index();
        $this->model('test_model');
    }

    public function index()
    {
        $this->loadView('welcome_view');
        $this->loadView('login_view');
    }


}
