<?php

include_once "../model/comments.model.php";

class commentsControl{

    public $comment;
    public $rating_comment;
    public $id_customer;
    public $id_service;


    public function addComments() {
        $objRespuesta = commentsModel::mdlComments($this->comment,$this->rating_comment,$this->id_customer,$this->id_service);
        echo json_encode($objRespuesta);
    }

}


if ($_POST["action"] == "create") {
    $objUsuarios = new commentsControl();
    $objUsuarios->rating_comment=$_POST["ratingComment"];
    if (isset($_POST["comment"])) {
        $objUsuarios->comment=$_POST["comment"];
    } else {
        $objUsuarios->comment=null;
    }
    $objUsuarios->id_customer=$_POST["idCustomer"];
    $objUsuarios->id_service=$_POST["idService"];
    $objUsuarios->addComments();
}

