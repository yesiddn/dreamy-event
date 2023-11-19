<?php
session_start();
include_once '../model/customer.model.php';

class CustomerControl {
  public $name;
  public $lastName;
  public $email;
  public $phone;
  public $city;
  public $country;
  public $pass;
  public $img;

  public function createCustomer() {
    $newCustomer = CustomerModel::createCustomer($this->name, $this->lastName, $this->email, $this->phone, $this->city, $this->country, $this->pass, $this->img);

    return $newCustomer;
  }

  public function getByEmail() {
    $customer = CustomerModel::getByEmail($this->email);

    return $customer;
  }
}

if($_POST['action'] === 'create') {
  $customer = new CustomerControl();
  $customer->name = $_POST['name'];
  $customer->lastName = $_POST['last-name'];
  $customer->email = $_POST['email'];
  $customer->phone = $_POST['phone'];
  $customer->city = $_POST['city'];
  $customer->country = $_POST['country'];
  $customer->pass = $_POST['pass'];
  $customer->img = $_FILES['img'];
  $response = $customer->createCustomer();
  echo json_encode($response);
}

if ($_POST['action'] === 'get-by-email') {
  $customer = new CustomerControl();
  $customer->email = $_POST['email'];
  $customer = $customer->getByEmail();
  echo json_encode($customer);

}