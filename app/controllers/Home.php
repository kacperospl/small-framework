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
        Session::AddSessionVariable('a','xds');
        echo Session::GetSessionVariable('a');
    }


}
