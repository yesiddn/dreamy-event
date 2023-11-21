<?php

include_once "../model/services.model.php";

class ShowServices{
  public $idService;

  public function getService() {
    $response = ServicesModel::getService($this->idService);
    echo json_encode($response);
  }
}

if (isset($_POST['action']) == 'read') {
    $showServices = new ShowServices();
    $showServices->idService = $_POST['idService'];
    $showServices->getService();
}