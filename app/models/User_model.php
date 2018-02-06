<?php

class User_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($login, $password)
    {
        $prep = $this->database->prepare("SELECT * FROM login_system WHERE login= ? AND password= ?");
        $prep->bindParam(1, $login, PDO::PARAM_STR);
        $prep->bindParam(2, $password, PDO::PARAM_STR);
        $prep->execute();

        if ($prep->rowCount() >= 1) {
            return true;
        } else {
            return false;
        }
    }
}
