<?php

class test_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test()
    {
        $res = $this->database->query('SELECT * FROM `newsletter`');
        $this->database->execute('INSERT INTO newsletter (mail) VALUES (?)', ['lol@lol.com']);
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
