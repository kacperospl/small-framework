<?php

class Login_model extends Model
{

  public function __construct()
  {
      parent::__construct();
  }

  public function verifyUser($login,$password)
  {
    $res = $this->database->execute("SELECT * FROM login_system WHERE password = ? AND login = ?",array($password,$login));
    if($res->rowCount() >= 1){
      echo 'zalogowano';
    }else {
      echo 'nie zalogowano';
    }

  }


}



 ?>
