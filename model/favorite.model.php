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
}