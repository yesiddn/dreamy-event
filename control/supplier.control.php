<?php
session_start();
include_once '../model/supplier.model.php';

class SupplierControl {
  public $name;
  public $email;
  public $phone;
  public $rut;
  public $city;
  public $country;
  public $img;
  public $userId;

  public function createSupplier() {
    $newSupplier = SupplierModel::createSupplier($this->name, $this->email, $this->phone, $this->rut, $this->city, $this->country, $this->img, $this->userId);

    echo json_encode($newSupplier);
  }
}

if($_POST['action'] == 'create') {
  $customer = new SupplierControl();
  $customer->name = $_POST['name'];
  $customer->email = $_POST['email'];
  $customer->phone = $_POST['phone'];
  $customer->rut = $_POST['rut'];
  $customer->city = $_POST['city'];
  $customer->country = $_POST['country'];
  $customer->img = $_FILES['img'];
  $customer->userId = $_POST['id_user'];
  $customer->createSupplier();
}