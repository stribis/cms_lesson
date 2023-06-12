<?php

require_once(__dir__ . '/Db.php');
class HomeModel extends Db {

  public function fetchPosts () :array {
    $this->query("SELECT * FROM `db_posts` ORDER BY `date_posted` DESC");
    $this->execute();

    $Posts = $this->fetchAll();

    if (count($Posts) > 0 ) {
      $Response = array (
        'status' => true,
        'data' => $Posts
      );

      return $Response;
    } else {
      $Response = array (
        'status' => false,
        'data' => []
      );

      return $Response;
    }
  }
    
}



?>