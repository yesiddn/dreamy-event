<?php
// iniciar sesion
session_start();
include_once '../model/login.model.php';

class LoginControl {
  public $email;
  public $pass;

  public function login() {
    $customer = LoginModel::login($this->email, $this->pass);

    return $customer;
  }
}

if ($_POST['action'] === 'login') {
  $customer = new LoginControl();
  $customer->email = $_POST['email'];
  $customer->pass = $_POST['pass'];
  $customer = $customer->login();
  echo json_encode($customer);
}