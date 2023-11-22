<?php

include_once 'connection.model.php';

class supplierModel{
    public static function mdlSupplier($nameCompany,$email,$phone,$rut,$city,$country,$image,$userId){

        $mensaje = array();
        try {
            $objRespuesta = Connection::connect()->prepare("INSERT INTO supplier(name_company,email_company,phone_company,rut_company,city_company,country_company,image_company,id_user)VALUES(:name_company,:email_company,:phone_company,:rut_company,:city_company,:country_company,:image_company,:id_user) ");        
            $objRespuesta->bindParam(":name_company",$nameCompany);
            $objRespuesta->bindParam(":email_company",$email);
            $objRespuesta->bindParam(":phone_company",$phone);
            $objRespuesta->bindParam(":rut_company",$rut);
            $objRespuesta->bindParam(":city_company",$city);
            $objRespuesta->bindParam(":country_company",$country);
            $objRespuesta->bindParam(":image_company",$image);
            $objRespuesta->bindParam(":id_user",$userId);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo"=>"200","mensaje"=>"Registrado correctamente");
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"No se ha podido registrar correctamente");

            }
            
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"425","mensaje"=>$e->getMessage());
            
        }
        return $mensaje;

    }
}