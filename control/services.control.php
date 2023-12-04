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

  public function getServicesSupplier()
  {
    $getServiceSupplier = ServicesModel::getServicesSupplier($this->idSupplier);
    echo json_encode($getServiceSupplier);
  }
}

if ($_POST["action"] == "read") {
  $getServices = new ServiceControl();
  $getServices->idCustomer = $_POST["idCustomer"];
  if ($_POST["category"] == "all") {
    $getServices->getServices();
  }
}

if ($_POST["action"] == "reads") {
  $getServicesSupplier = new ServiceControl();
  $getServicesSupplier->idSupplier = $_POST["idSupplier"];
  if ($_POST["category"] == "all") {
    $getServicesSupplier->getServicesSupplier();
  }
}
