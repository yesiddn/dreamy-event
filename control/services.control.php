<?php
include_once "../model/services.model.php";

class ServiceControl
{
  public $nameService;
  public $descriptionService;
  public $price;
  public $location;
  public $city;
  public $country;
  public $amountPeople;
  public $characteristics;
  public $idTypeService;
  public $idSupplier;

  public function createService()
  {
    $newService = ServicesModel::createService($this->nameService, $this->descriptionService, $this->price, $this->location, $this->city, $this->country, $this->amountPeople, $this->characteristics);
  }

  public function getServices()
  {
    $getService = ServicesModel::getServices();
    echo json_encode($getService);
  }
}

if ($_POST["action"] == "read") {
  $getServices = new ServiceControl();
  if ($_POST["category"] == "all") {
    $getServices->getServices();
  }
}

$ServiceControl = new ServiceControl();
if ($_POST['queryType'] == 'Insert') {
  $ServiceControl->nameService = $_POST['nameService'];
  $ServiceControl->descriptionService = $_POST['descriptionService'];
  $ServiceControl->price = $_POST['price'];
  $ServiceControl->location = $_POST['location'];
  $ServiceControl->city = $_POST['city'];
  $ServiceControl->country = $_POST['country'];
  $ServiceControl->amountPeople = $_POST['amountPeople'];
  $ServiceControl->characteristics = $_POST['characteristics'];
  $ServiceControl->createService();
}
