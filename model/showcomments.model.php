<?php

include_once 'connection.model.php';

class showCommentsModel{
    
    public static function mdlShowComments($idService){
        $ShowComments=null;

        try {
            $objRespuesta = Connection::connect()->prepare("SELECT c.comentario,c.calificacion_comentario,c.id_servicio,cu.name_customer,cu.last_name_customer FROM comments c,customers cu WHERE c.id_customer=cu.id_customer and c.id_servicio=?");
            $objRespuesta->bindParam(1, $idService, PDO::PARAM_INT);
            $objRespuesta->execute();
            $ShowComments = $objRespuesta->fetchAll();
            if (!$ShowComments) {
                return array("codigo" => "400", "mensaje" => "No se encontraron comentarios para este servicio");
            }
            return array("codigo" => "200", "mensaje" => "OK", "data" => $ShowComments);
        } catch (Exception $e) {
            return array("codigo" => "500", "mensaje" => $e->getMessage());
        }
    }
}
