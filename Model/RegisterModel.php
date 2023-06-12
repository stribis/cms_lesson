<?php

require_once(__dir__ . '/Db.php');
class RegisterModel extends Db {

  public function createUser(array $user) :array  {
    $this->query("INSERT INTO `db_user` (name, email, password) VALUES (:name, :email, :password)");
    $this->bind('name', $user['name']);
    $this->bind('email', $user['email']);
    $this->bind('password', $user['password']);

    if($this->execute()) {
      $Response = array(
        'status' => true
      );
    } else {
      $Response = array(
        'status' => false
      );
    }
    return $Response;
  }


  public function fetchUser (string $email) :array {
    $this->query("SELECT * FROM `db_user` WHERE `email` = :email");
    $this->bind('email', $email);
    $this->execute();

    $User = $this->fetch();
    if(!empty($User)) {
      $Response = array(
        'status' => true,
        'data' => $User
      );
    } else {
      $Response = array(
        'status' => false,
        'data' => []
      );
    }
    return $Response;
  }

}



?>