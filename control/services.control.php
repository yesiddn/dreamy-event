<?php

include_once "../model/services.model.php";

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
        $newService = ServiceModel::createService();

    }

    public function editService(){
        $editService = ServiceModel::editServiceInfo();

    }

    public function deleteService(){
        $deleteService = ServiceModel::deleteService();

    }

    public function getService(){
        $getService = ServicesModel::getServices();
        echo json_encode($getService);
    }
}

$getServiceControl = new ServiceControl();
$getServiceControl->getService();


