<?php

class SupplierControl {
  public $nameCompany;
  public $email;
  public $phone;
  public $rut;
  public $city;
  public $country;
  public $userId;
}

if($_POST['action'] == 'create') {
  $customer = new SupplierControl();
  $customer->nameCompany = $_POST['name_company'];
  $customer->email = $_POST['email'];
  $customer->phone = $_POST['phone'];
  $customer->rut = $_POST['rut'];
  $customer->city = $_POST['city'];
  $customer->country = $_POST['country'];
  $customer->userId = $_POST['id_user'];
}