<?php

class test_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test()
    {
      $res =  $this->database->query('SELECT * FROM `newsletter`');

      foreach ($res as $row) {
        echo $row['ID'] ;
        echo $row['mail'] ;
            echo '<br>';
     }


    }

    public function argtest($text)
    {
        echo $text;
    }
}
