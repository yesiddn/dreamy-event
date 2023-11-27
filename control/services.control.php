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
  public $idCustomer;

  public function getServices()
  {
    $getService = ServicesModel::getServices($this->idCustomer);
    echo json_encode($getService);
  }
}

if ($_POST["action"] == "read") {
  $getServices = new ServiceControl();
  $getServices->idCustomer = $_POST["idCustomer"];
  if ($_POST["category"] == "all") {
    $getServices->getServices();
  }
}
