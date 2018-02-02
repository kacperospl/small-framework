<?php
class Home extends Controller
{

  public function __construct()
  {
    $this->index();
    $test_model =  $this->model('test_model');
    $test_model->test();
  }

  public function index(){
    $this->load_view('welcome_view');
  }



}



 ?>
