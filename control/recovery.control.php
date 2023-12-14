<?php
// iniciar sesion
session_start();
include_once '../model/recovery.model.php';

class LoginControl
{
  public $email;
  public $code;

  public function login()
  {
    $User = LoginModel::login($this->email);

    return $User;
  }

  public function validationProcess()
  {
    $User = LoginModel::codeValidation($this->code);
    return $User;
  }
}



if ($_POST['action'] === 'recovery') {
  $User = new LoginControl();
  $User->email = $_POST['email'];
  $User = $User->login();
  $_SESSION['currentUserData'] = $User['data']; // saving in session the useful current user data
  echo json_encode($User);
  
} elseif ($_POST['action'] === 'validationCode') {
  $User = new LoginControl();
  $User->code = $_POST['code'];
  $User = $User->validationProcess();
  echo json_encode($User);
}
