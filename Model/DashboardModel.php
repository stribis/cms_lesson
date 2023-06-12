<?php

require_once(__dir__ . '/Db.php');
class DashboardModel extends Db { 

  public function fetchPosts (int $id) :array {
    $this->query("SELECT * FROM `db_posts` WHERE `op` = :op");
    $this->bind('op', $id);
    $this->execute();

    $Posts = $this->fetchAll();
    if(count($Posts) > 0) {
      $Response = array(
        'status' => true,
        'data' => $Posts
      );
      return $Response;
    } 

    $Response = array(
      'status' => false,
      'data' => []
    );
    return $Response;
  }

  public function createPost (array $post) :array {
    $this->query("INSERT INTO `db_posts` (title, content, contact, image, op) VALUES (:title, :content, :contact, :image, :op)");
    $this->bind('title', $post['title']);
    $this->bind('content', $post['message']);
    $this->bind('contact', $post['email']);
    $this->bind('image', $post['image']);
    $this->bind('op', $_SESSION['data']['id']);


    if($this->execute()) {
      $Response = array(
        'status' => true
      );
      return $Response;
    } 

    $Response = array(
      'status' => false
    );
    return $Response;

  }




}


?>