<?php

class test_model extends Model {

public function __construct()
{
  parent::__construct();
}

public function test()
{
  echo 'this is test model';
  echo '<br>';
}

public function argtest($text)
{
  echo $text;
}


}




 ?>
