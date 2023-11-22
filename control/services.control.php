<?php
include_once "../model/services.model.php";
include_once "../model/files.model.php";

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

  public $servicePics;

  public function createService()
  {

    $data = [
      'name' => $this->nameService,
      'description' => $this->descriptionService,
      'price' => $this->price,
      'location' => $this->location,
      'city' => $this->city,
      'country' => $this->country,
      'amount' => $this->amountPeople,
      'characteristics' => $this->characteristics,
      'service-type' => 1,
      'supplier-type' => 1,
      'service-pics'=> $this->servicePics,
    ];
    $newService = ServicesModel::createService($data);
    $fileService = FIlesModel::saveImage($data['service-pics']);

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



if ($_POST['queryType'] == 'Insert') {
  $ServiceControl = new ServiceControl();
  $ServiceControl->nameService = $_POST['nameService'];
  $ServiceControl->descriptionService = $_POST['descriptionService'];
  $ServiceControl->price = $_POST['price'];
  $ServiceControl->location = $_POST['location'];
  $ServiceControl->city = $_POST['city'];
  $ServiceControl->country = $_POST['country'];
  $ServiceControl->amountPeople = $_POST['amountPeople'];
  $ServiceControl->characteristics = $_POST['characteristics'];
  $ServiceControl->servicePics = $_FILES['servicePics'];
  $ServiceControl->createService();




}
