<?php

include_once "../model/filter-bar.model.php";

class ShowTypeServiceControl {    
    public function showTypeServices() {
        $objRespuesta = showTypeServiceModel::mdlShowTypeServices();
        return $objRespuesta; // No hacemos json_encode aquí
    }
}

if ($_POST["showTypeService"] == "OK") {
    $objService = new ShowTypeServiceControl();
    $serviceData = $objService->showTypeServices();
    echo json_encode($serviceData);
}
