<?php
include_once 'connection.model.php';

class TypeServicesModel
{
  public static function getTypeServices()
  {
    try {
      $query = "SELECT * FROM type_services";
      $result = Connection::connect()->prepare($query);
      $result->execute();
      $typeServices = $result->fetchAll();
      return array("codigo" => "200", "mensaje" => "ok", "data" => $typeServices);
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function getTypeServiceById($id) {
    try {
      $query = "SELECT * FROM type_services WHERE id_type_service = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $id, PDO::PARAM_INT);
      $result->execute();
      $typeService = $result->fetch();
      return array("codigo" => "200", "mensaje" => "ok", "data" => $typeService);
    } catch(Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function createTypeService($data) {
    try {
      $query = "INSERT INTO type_services (name_type_service, image_type_service) VALUES (?, ?))";
      $connetion = Connection::connect();
      $result = $connetion->prepare($query);
      $result->bindParam(1, $data['name'], PDO::PARAM_STR);
      $result->bindParam(2, $data['image'], PDO::PARAM_STR);

      if ($result->execute()) {
        $typeServiceId = $connetion->lastInsertId();
      } else {
        return array("codigo" => "500", "mensaje" => $connetion->errorInfo()[2]);
      }

      $data['id'] = $typeServiceId;

      return array("codigo" => "200", "mensaje" => "ok", "data" => $data);
    } catch(Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function editTypeService($data) {
    try {
      $query = "UPDATE type_services SET name_type_service = ?, image_type_service = ? WHERE id_type_service = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $data['name'], PDO::PARAM_STR);
      $result->bindParam(2, $data['image'], PDO::PARAM_STR);
      $result->bindParam(3, $data['id'], PDO::PARAM_INT);
      $result->execute();
      return array("codigo" => "200", "mensaje" => "ok");
    } catch(Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function editTypeServiceName($data) {
    try {
      $query = "UPDATE type_services SET name_type_service = ? WHERE id_type_service = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $data['name'], PDO::PARAM_STR);
      $result->bindParam(2, $data['id'], PDO::PARAM_INT);
      $result->execute();
      return array("codigo" => "200", "mensaje" => "ok");
    } catch(Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function editTypeServiceImage($data) {
    try {
      $query = "UPDATE type_services SET image_type_service = ? WHERE id_type_service = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $data['image'], PDO::PARAM_STR);
      $result->bindParam(2, $data['id'], PDO::PARAM_INT);
      $result->execute();
      return array("codigo" => "200", "mensaje" => "ok");
    } catch(Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function deleteTypeService($id) {
    try {
      $query = "DELETE FROM type_services WHERE id_type_service = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $id, PDO::PARAM_INT);
      $result->execute();
      return array("codigo" => "200", "mensaje" => "ok");
    } catch(Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }
}
