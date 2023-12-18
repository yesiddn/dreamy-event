<?php

include_once "../model/showcomments.model.php";

class showCommentsControl{
    public $idService;

    
    public function showComments() {
        $objRespuesta = showCommentsModel::mdlShowComments($this->idService);
        echo json_encode($objRespuesta);
    }

}


if ($_POST["showComments"] == "OK") {

    $objUsuario = new showCommentsControl();
    $objUsuario-> idService = $_POST["idService"];
    $objUsuario->showComments();
    
}


