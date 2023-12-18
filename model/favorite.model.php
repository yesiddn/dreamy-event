<?php
include_once 'connection.model.php';

class FavoriteServiceModel {
  public static function addFavoriteService($idService, $idCustomer) {
    $serviceExists = self::serviceExists($idService, $idCustomer);

    if ($serviceExists['data']) {
      return array('status' => 400, 'message' => 'El servicio ya existe en favoritos');
    }

    $sql = "INSERT INTO favorites (id_service, id_customer) VALUES (?, ?)";
    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $idService, PDO::PARAM_INT);
    $query->bindParam(2, $idCustomer, PDO::PARAM_INT);

    if ($query->execute()) {
      return array('status' => 201, 'message' => 'Servicio agregado a favoritos');
    } else {
      return array('status' => 500, 'message' => 'No se pudo agregar el servicio a favoritos');
    }
  }

  public static function serviceExists($idCustomer, $idService) {
    $sql = "SELECT * FROM favorites WHERE id_service = ? AND id_customer = ?";
    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $idCustomer, PDO::PARAM_INT);
    $query->bindParam(2, $idService, PDO::PARAM_INT);
    $query->execute();
    $service = $query->fetchAll();

    return array('status' => 200, 'message' => 'Servicio favorito obtenido', 'data' => $service);
  }

  public static function readFavoriteServices($idCustomer) {
    try {
      $query = "SELECT services.id_service, services.name_service, services.description_service, services.price, services.location, services.city, services.country, services.amount_people, services.characteristics, ROUND(AVG(COALESCE(comments.calificacion_comentario, 0)), 1) AS rating, services.id_type_service, services.id_supplier, images_services.id_image, images_services.url_image FROM services INNER JOIN images_services ON services.id_service = images_services.id_service LEFT JOIN comments ON comments.id_servicio = services.id_service INNER JOIN favorites ON services.id_service = favorites.id_service WHERE favorites.id_customer = ? GROUP BY comments.id_servicio;";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $idCustomer, PDO::PARAM_INT);
      $result->execute();
      $services = $result->fetchAll();
      $result = null;

      return array("codigo" => "200", "mensaje" => "ok", "data" => $services);
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function deleteFavoriteService($idService, $idCustomer) {
    try {
      $sql = "DELETE FROM favorites WHERE id_service = ? AND id_customer = ?";
      $query = Connection::connect()->prepare($sql);
      $query->bindParam(1, $idService, PDO::PARAM_INT);
      $query->bindParam(2, $idCustomer, PDO::PARAM_INT);

      if ($query->execute()) {
        return array('status' => 200, 'message' => 'Servicio eliminado de favoritos');
      } else {
        return array('status' => 500, 'message' => 'No se pudo eliminar el servicio de favoritos');
      }
    } catch (Exception $e) {
      return array('status' => 500, 'message' => $e->getMessage());
    }
  }
}