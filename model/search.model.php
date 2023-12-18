<?php

include_once 'connection.model.php';

class ShowSearchModel
{
    public static function mdlShowSearch($result, $idCustomer, $searchKeyword)
    {
        try {
            if ($idCustomer === null) {
                $query = "SELECT services.id_service, services.name_service, services.description_service, services.price, services.location, services.city, services.country, services.amount_people, services.characteristics, ROUND(AVG(COALESCE(comments.calificacion_comentario, 0)), 1) AS rating, services.id_type_service, services.id_supplier, images_services.id_image, images_services.url_image FROM services INNER JOIN images_services ON services.id_service = images_services.id_service LEFT JOIN comments ON comments.id_servicio = services.id_service WHERE services.name_service LIKE ?;";
                $result = Connection::connect()->prepare($query);
                
                $searchKeywordParam = '%' . $searchKeyword . '%';
                $result->bindValue(1, $searchKeywordParam, PDO::PARAM_STR);
            } else {
                $query = "SELECT services.id_service, services.name_service, services.description_service, services.price, services.location, services.city, services.country, services.amount_people, services.characteristics, ROUND(AVG(COALESCE(comments.calificacion_comentario, 0)), 1) AS rating, services.id_type_service, services.id_supplier, images_services.id_image, images_services.url_image, favorites.id_customer AS is_favorite FROM services INNER JOIN images_services ON services.id_service = images_services.id_service LEFT JOIN favorites ON services.id_service = favorites.id_service AND favorites.id_customer = ? LEFT JOIN comments ON comments.id_servicio = services.id_service WHERE services.name_service LIKE ? GROUP BY comments.id_servicio;";
                $result = Connection::connect()->prepare($query);
                $result->bindValue(1, $idCustomer, PDO::PARAM_INT);
                $searchKeywordParam = '%' . $searchKeyword . '%';
                $result->bindValue(2, $searchKeywordParam, PDO::PARAM_STR);
            }


            $result->execute();
            $services = $result->fetchAll();
            $result = null;

            return array("codigo" => "200", "mensaje" => "ok", "data" => $services);
        } catch (Exception $e) {
            return array("codigo" => "500", "mensaje" => $e->getMessage());
        }
    }
}
