<?php

include_once 'connection.model.php';

class showTypeServiceModel{
    
    public static function mdlShowTypeServices(){
        $typeService=null;

        try {
            $objRespuesta = Connection::connect()->prepare("SELECT * FROM type_services");
            $objRespuesta->execute();
            $typeService = $objRespuesta->fetchAll();
            $objRespuesta = null;
            
        } catch (Exception $e) {
            $typeService = $e->getMessage();
        }
        return $typeService;
    }

}
