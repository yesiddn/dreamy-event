<?php
// iniciar sesion
session_start();
include_once '../model/recovery.model.php';

class LoginControl {
  public $email;

  public function login() {
    $User = LoginModel::login($this->email);

    return $User;
  }
}

if ($_POST['action'] === 'recovery') {
  $User = new LoginControl();
  $User->email = $_POST['email'];
  $User = $User->login();
  echo json_encode($User);
}