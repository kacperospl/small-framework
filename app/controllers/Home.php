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

    }
}
