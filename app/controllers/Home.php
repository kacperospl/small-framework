<?php
class Home extends Controller
{
    public function __construct()
    {
        $this->index();
        $test_model = $this->model('test_model');
        $this->modelFunction('test_model', 'test', array());
        $this->modelFunction('test_model', 'argtest', array('arguments'));
    }

    public function index()
    {
        $this->load_view('welcome_view');
    }

    public function test()
    {
        echo 'test';
    }
}
