<?php
include_once "../model/services.model.php";
include_once "../model/files.model.php";

class ServiceControl
{
  public $idEvent;
  public $idService;
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
      'id_type_service' => $this->idTypeService,
      'id_supplier' => $this->idSupplier,
      'service-pics' => $this->servicePics,
    ];
    $newService = ServicesModel::createService($data);
    $fileService = FilesModel::createServiceImages($newService['data']['id'], $data['service-pics']);
    echo json_encode($newService,$fileService);
  }

  public function editService() {
    $service = ServicesModel::editService($this->idService, $this->nameService, $this->descriptionService, $this->price, $this->location, $this->city, $this->country, $this->amountPeople, $this->characteristics, $this->idTypeService);
    echo json_encode($service);
  }

  public function deleteService()
  {
    $service = ServicesModel::deleteService($this->idService);
    echo json_encode($service);
  }

  public function getServices()
  {
    $getService = ServicesModel::getServices($this->idCustomer);
    echo json_encode($getService);
  }
  
  public function getEventServices()
  {
    $getEventServices = ServicesModel::getEventServices($this->idEvent);
    echo json_encode($getEventServices);
  }

  public function getServicesByType()
  {
    $services = ServicesModel::getServicesByType($this->idCustomer, $this->idTypeService);
    echo json_encode($services);
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
  
if ($_POST["action"] == "read event services") {
  $getServices = new ServiceControl();
  $getServices->idEvent = $_POST["eventId"];
  $getServices->getEventServices();  
}

if ($_POST["action"] == "read by type") {
  $getServices = new ServiceControl();
  $getServices->idCustomer = $_POST["idCustomer"];
  $getServices->idTypeService = $_POST["idTypeService"];
  $getServices->getServicesByType();
}

if (isset($_POST['queryType']) == 'Insert') {
  $ServiceControl = new ServiceControl();
  $ServiceControl->nameService = $_POST['name-service'];
  $ServiceControl->descriptionService = $_POST['description-service'];
  $ServiceControl->price = $_POST['price-service'];
  $ServiceControl->location = $_POST['location-service'];
  $ServiceControl->city = $_POST['city-service'];
  $ServiceControl->country = $_POST['country-service'];
  $ServiceControl->amountPeople = $_POST['peopleAmount-service'];
  $ServiceControl->characteristics = $_POST['characteristics-service'];
  $ServiceControl->idTypeService = $_POST['type-service'];
  $ServiceControl->idSupplier = $_POST['id_supplier'];

  $filesData = $_FILES['images'];
  $newArrayFiles = [];
  foreach ($filesData['name'] as $index => $name) {
    $newArrayFiles[] = [
      'name' => $name,
      'type' => $filesData['type'][$index],
      'tmp_name' => $filesData['tmp_name'][$index],
      'error' => $filesData['error'][$index],
      'size' => $filesData['size'][$index]
    ];
  }

  $ServiceControl->servicePics = $newArrayFiles;
  $ServiceControl->createService();
}

if (isset($_POST["action"]) && $_POST["action"] == "update") {
  $service = new ServiceControl();
  $service->idService = $_POST["idService"];
  $service->nameService = $_POST["name-service"];
  $service->descriptionService = $_POST["description-service"];
  $service->price = $_POST["price-service"];
  $service->location = $_POST["location-service"];
  $service->city = $_POST["city-service"];
  $service->country = $_POST["country-service"];
  $service->amountPeople = $_POST["peopleAmount-service"];
  $service->characteristics = $_POST["characteristics-service"];
  $service->idTypeService = $_POST["type-service"];
  $service->editService();
}

if (isset($_POST["action"]) && $_POST["action"] == "delete") {
  $service = new ServiceControl();
  $service->idService = $_POST["idService"];
  $service->deleteService();
}
