<?php

include_once 'connection.model.php';

class commentsModel{
    public static function mdlComments($comment,$rating_comment,$id_customer,$id_service){

        $mensaje = array();
        try {
            if ($comment == null) {
                $objRespuesta = Connection::connect()->prepare("INSERT INTO comments(calificacion_comentario,id_customer,id_servicio)VALUES(:calificacion_comentario,:id_customer,:id_servicio)");        
                $objRespuesta->bindParam(":comentario",$comment);
            } else {
                $objRespuesta = Connection::connect()->prepare("INSERT INTO comments(comentario,calificacion_comentario,id_customer,id_servicio)VALUES(:comentario,:calificacion_comentario,:id_customer,:id_servicio)");        
            }
            
            $objRespuesta->bindParam(":calificacion_comentario",$rating_comment);
            $objRespuesta->bindParam(":id_customer",$id_customer);
            $objRespuesta->bindParam(":id_servicio",$id_service);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo"=>200, "mensaje"=>"Gracias por tu calificación y tu comentario");
            }else{
                $mensaje = array("codigo"=>500, "mensaje"=>"No se ha podido agregar tu calificación y comentario");

            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>500,"mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }
}