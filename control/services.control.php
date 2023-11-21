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
