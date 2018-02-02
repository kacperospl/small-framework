<?php
class Home extends Controller
{

  public function __construct()
  {
    $this->index();
  }

  public function index(){
    $this->load_view('test_view');
  }



}



 ?>
