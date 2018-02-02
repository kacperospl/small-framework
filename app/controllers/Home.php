<?php
class Home extends Controller
{

  public function __construct()
  {
    $this->index();
    $this->add_model($login_model, new test_model());
  }

  public function index(){
    $this->load_view('test_view');
  }



}



 ?>
