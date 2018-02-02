<?php
class Home extends Controller
{

  public function __construct()
  {
    $this->index();
    $this->add_model("test_model", new test_model());
  }

  public function index(){
    $this->load_view('welcome_view');

  }



}



 ?>
