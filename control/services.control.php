<?php
include_once '../model/services.model.php';

class ServiceControl{
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

    public function createService(){
        $newService = ServiceModel::createService($this->nameService,$this->descriptionService,$this->price,$this->location,$this->city,$this->country,$this->amountPeople,$this->characteristics);

    }

    public function editService(){
        $editService = ServiceModel::editServiceInfo();

    }

    public function deleteService(){
        $deleteService = ServiceModel::deleteService();

    }

    public function getService(){
        $getService = ServiceModel::getServices();
        echo json_encode($getService);
    }
}


$ServiceControl = new ServiceControl();
if ($_POST['queryType']=='Insert') {
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
