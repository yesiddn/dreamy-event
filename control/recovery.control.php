<?php
// iniciar sesion
session_start();
include_once '../model/recovery.model.php';

class LoginControl {
  public $email;

  public function login() {
    $customer = LoginModel::login($this->email);

    return $customer;
  }
}

if ($_POST['action'] === 'recovery') {
  $customer = new LoginControl();
  $customer->email = $_POST['email'];
  $customer = $customer->login();
  echo json_encode($customer);
}