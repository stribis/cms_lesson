<?php
require_once(__dir__ . '/Controller.php');
require_once('Model/LoginModel.php');

class Login extends Controller {

  private $loginModel;

  public function __construct()
  {
    if (isset($_SESSION['auth_status'])) header("Location: dashboard.php");
    $this->loginModel = new LoginModel();
  }

  public function login (array $data) {
    $email = stripcslashes(strip_tags($data['email']));
    $password = stripcslashes(strip_tags($data['password']));

    $EmailRecords = $this->loginModel->fetchEmail($email);

    if (!$EmailRecords['status']) {
      if (password_verify($password, $EmailRecords['data']['password'])) {
        // TODO: Check if the remember-me is selected 

        $Response = array(
          'status' => true
        ); 

        $_SESSION['data'] = $EmailRecords['data'];
        $_SESSION['auth_status'] = true;
        header('Location: /dashboard.php');
      }

      $Response = array(
        'status' => false
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