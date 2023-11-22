<?php

class SupplierControl {
  public $nameCompany;
  public $email;
  public $phone;
  public $rut;
  public $city;
  public $country;
  public $image;
  public $userId;

  public function addSupplier() {
    $objRespuesta = supplierModel::mdlSupplier($this->nameCompany,$this->email,$this->phone,$this->rut,$this->city,$this->country,$this->image,$this->userId);
    echo json_encode($objRespuesta);
}

}

if($_POST['action'] == 'create') {
  $customer = new SupplierControl();
  $customer->nameCompany = $_POST['name_company'];
  $customer->email = $_POST['email'];
  $customer->phone = $_POST['phone'];
  $customer->rut = $_POST['rut'];
  $customer->city = $_POST['city'];
  $customer->country = $_POST['country'];
  $customer->image = $_POST['image'];
  $customer->userId = $_POST['id_user'];
}


 