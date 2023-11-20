<?php

include_once "connection.model.php.php";

class Showservices{

    public static function NameService(){

        $ShowServices=null;

        try {
            $objRespuesta = Connection::connect()->prepare("SELECT name_service FROM services");
            $objRespuesta->execute();
            $ShowServices = $objRespuesta->fetchAll();
            $objRespuesta = null;

            return array("codigo"=>"200","mensaje"=>"Ubication OK");
            
        } catch (Exception $e) {
            return array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $ShowServices;
    }

    public static function UbicationService(){

        $ShowServices=null;

        try {
            $objRespuesta = Connection::connect()->prepare("SELECT (location,country,city) FROM services");
            $objRespuesta->execute();
            $ShowServices = $objRespuesta->fetchAll();
            $objRespuesta = null;

            return array("codigo"=>"200","mensaje"=>"Ubication OK");
            
        } catch (Exception $e) {
            return array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $ShowServices;
    }

    public static function DescriptionService(){

        $ShowServices=null;

        try {
            $objRespuesta = Connection::connect()->prepare("SELECT description_service FROM services");
            $objRespuesta->execute();
            $ShowServices = $objRespuesta->fetchAll();
            $objRespuesta = null;

            return array("codigo"=>"200","mensaje"=>"Name OK");
            
        } catch (Exception $e) {
            return array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $ShowServices;
    }

    public static function PriceService(){

        $ShowServices=null;

        try {
            $objRespuesta = Connection::connect()->prepare("SELECT name_service FROM services");
            $objRespuesta->execute();
            $ShowServices = $objRespuesta->fetchAll();
            $objRespuesta = null;

            return array("codigo"=>"200","mensaje"=>"Price OK");
            
        } catch (Exception $e) {
            return array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $ShowServices;
    }

}

