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

  public function deletePost (int $id) :bool {
    $this->query("DELETE FROM `db_posts` WHERE `id` = :id AND `op` = :op");
    $this->bind('id', $id);
    $this->bind('op', $_SESSION['data']['id']);
    $deleted = $this->execute();

    return $deleted;
  }

  public function fetchPost (int $id) :array {
    $this->query("SELECT * FROM `db_posts` WHERE `id` = :id");
    $this->bind('id', $id);
    $this->execute();

    $Post = $this->fetch();
    if(count($Post) > 0) {
      $Response = array(
        'status' => true,
        'data' => $Post
      );
      return $Response;
    } 

    $Response = array(
      'status' => false,
      'data' => []
    );
    return $Response;


  }

  public function updatePost (array $post, int $id) :array {
    $this->query("UPDATE `db_posts` SET title=:title, content=:content, contact=:contact, image=:image, op=:op WHERE id=:id");
    $this->bind('title', $post['title']);
    $this->bind('content', $post['message']);
    $this->bind('contact', $post['email']);
    $this->bind('image', $post['image']);
    $this->bind('op', $_SESSION['data']['id']);
    $this->bind('id', $id);

    if($this->execute()) {
      $Response = array (
        'status' => true
      );
      return $Response;
    } else {
      $Response = array (
        'status' => false
      );
      return $Response;
    }
  }


}


?>