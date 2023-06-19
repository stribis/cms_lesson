<?php

require_once(__dir__ . '/Controller.php');
require_once(dirname(__dir__) . '/Model/DashboardModel.php');

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

  public function deletePost(int $id) {
    if ($this->dashboardModel->deletePost($id)) header('Location: /dashboard.php?deleted');
  }

  public function createPost(array $data, $files) :array {
    $title = stripcslashes(strip_tags($data['title']));
    $email = stripcslashes(strip_tags($data['email']));
    $message = stripcslashes(strip_tags($data['message']));

    $file = $files['image'];

    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $Error = array ( 
      'title' => '',
      'email' => '',
      'message' => '',
      'image' => '',
      'status' => false
    );

    if($fileError === UPLOAD_ERR_OK) {
      if ($fileSize <= 3 * 1024 * 1024) {
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        if (in_array($extension, $allowedExtensions)) {
          // Generate a unique name
          $uniqueName = uniqid('image_') . '_' . time();
          $uniqueName .= '.' . $extension;
          $uploadPath = '../uploads/' . $uniqueName;
          move_uploaded_file($fileTmp, $uploadPath);
        } else {
          $Error['image'] = 'Only JPG, PNG, GIF, and WEBP files are allowed';
          return $Error;
        }
      } else {
        $Error['image'] = 'The image must be under 3 MB';
        return $Error;
      }
    } else {
      $Error['image'] = 'Something went wrong with your upload, try again!';
        return $Error;
    }

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
      'image' => $uniqueName
    );

    $Response = $this->dashboardModel->createPost($Payload);
    if (!$Response['status']) {
      $Response['status'] = 'Sorry an unexpected error occurred';
      return $Response;
    }

    header('Location: ../dashboard.php?created');
    return $Response;


  }

  public function getPost(int $id) :array {
    return $this->dashboardModel->fetchPost($id);
  }

  public function editPost (array $data, int $id, $files) :array {
    $title = stripcslashes(strip_tags($data['title']));
    $email = stripcslashes(strip_tags($data['email']));
    $message = stripcslashes(strip_tags($data['message']));
    $image = $data['original'];

    $Error = array ( 
      'title' => '',
      'email' => '',
      'message' => '',
      'image' => '',
      'status' => false
    );

    if ( isset ($files['image']['name']) && $files['image']['size'] > 0) {
      $imageName  = $data['original'];
      $imagePath = '../uploads/' . $imageName;

      $file = $files['image'];
      $fileName = $file['name'];
      $fileTmp = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];

      // Check for Errors
      if ( $fileError === UPLOAD_ERR_OK ) {
        if(file_exists($imagePath)) {
          unlink($imagePath);
        }
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'gif', 'webp', 'png');

        if (in_array($extension, $allowedExtensions)) {
          $uniqueName = uniqid(('image_') . '_' .time());
          $uniqueName .= '.' .$extension;
          $uploadPath = '../uploads/' . $uniqueName;
          move_uploaded_file($fileTmp, $uploadPath);
          $image = $uniqueName;
        } else { 
          $Error['image'] = 'Only JPG, PNG, GIF and WebP allowed.';
          return $Error;
        }
      } else { 
        $Error['image'] = 'Error uploading your image, please try again.';
        return $Error;
      }
    }

    // Check if Correct characters

    // check if message is long enough

    // check if email is email

    // USW:

    $Payload = array (
      'title' => $title,
      'email' => $email,
      'message' => $message,
      'image' => $image
    );

    $Response = $this->dashboardModel->updatePost($Payload, $id);

    if (!$Response['status']) {
      $Response['status'] = 'Sorry, an unexpected error occurred :(.';
      return $Response;
    }

    header("Location: /dashboard?updated");
    return array(true);
  }

}



?>