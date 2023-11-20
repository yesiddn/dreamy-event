<?php

include_once "../model/info-service.model.php";

class ShowServices{

    public function NameService(){
        $objRespuesta=ShowServices::NameService();
        echo json_encode($objRespuesta);
    }

    public function UbicationService(){
        $objRespuesta=ShowServices::UbicationService();
        echo json_encode($objRespuesta);
    }

    public function DescriptionService(){
        $objRespuesta=ShowServices::DescriptionService();
        echo json_encode($objRespuesta);
    }

    public function PriceService(){
        $objRespuesta=ShowServices::PriceService();
        echo json_encode($objRespuesta);
    }

}


if (isset($_POST["ShowServices"]) == "OK") {

    $objUsuario = new ShowServices();
    $objUsuario->NameService();
    
}