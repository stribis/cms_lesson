<?php

require_once(__dir__ . '/Controller.php');
require_once('../Model/DashboardModel.php');

class Dashboard extends Controller {

  private $dashboardModel;
  
  public function __construct()
  {
    if (!isset($_SESSION['auth_status'])) header('Location: index.php');
    $this->dashboardModel = new DashboardModel();
  }

  public function getPosts(int $id) :array {
    return $this->dashboardModel->fetchPosts($id);
  }

  public function createPost(array $data) :array {
    $title = stripcslashes(strip_tags($data['title']));
    $email = stripcslashes(strip_tags($data['email']));
    $message = stripcslashes(strip_tags($data['message']));

    /**
    * @TODO: Add image upload to createPost
    */

    $Error = array ( 
      'title' => '',
      'email' => '',
      'message' => '',
      'image' => '',
      'status' => false
    );

    /**
    * @TODO: Validate ALL the inputs
    */

    if (strlen($message) < 20) {
      $Error['message'] = 'Please write a longer message';
      return $Error;
    }

    $Payload = array(
      'title' => $title,
      'email' => $email,
      'message' => $message,
      'image' => ''
    );

    $Response = $this->dashboardModel->createPost($Payload);
    return $Response;

  }

}



?>