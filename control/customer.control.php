<?php

class CustomerControl {
  public $name;
  public $lastName;
  public $phone;
  public $email;
  public $pass;
}

if($_POST['action'] == 'create') {
  $customer = new CustomerControl();
  $customer->name = $_POST['name'];
  $customer->lastName = $_POST['lastName'];
  $customer->phone = $_POST['phone'];
  $customer->email = $_POST['email'];
  $customer->pass = $_POST['pass'];
}