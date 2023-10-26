<?php

class SupplierControl {
  public $name;
  public $lastName;
  public $email;
  public $phone;
  public $name_company;
  public $rut;
  public $city;
  public $country;
  public $password;
}

if($_POST['action'] == 'create') {
  $customer = new SupplierControl();
  $customer->name = $_POST['name'];
  $customer->lastName = $_POST['lastName'];
  $customer->email = $_POST['email'];
  $customer->phone = $_POST['phone'];
  $customer->name_company = $_POST['name_company'];
  $customer->rut = $_POST['rut'];
  $customer->city = $_POST['city'];
  $customer->country = $_POST['country'];
  $customer->password = $_POST['password'];
}