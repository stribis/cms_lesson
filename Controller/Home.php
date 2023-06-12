<?php
require_once(__dir__ . '/Controller.php');
require_once('Model/HomeModel.php');

class Home extends Controller {

  private $homeModel;

  public function __construct()
  {
    $this->homeModel = new HomeModel();
  }

  public function getPosts() :array {
    return $this->homeModel->fetchPosts();
  }

  
  
}

?>