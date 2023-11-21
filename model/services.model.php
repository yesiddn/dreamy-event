<?php
include_once 'connection.model.php';

class ServicesModel
{
  public static function getServices()
  {
    try {
      $query = "SELECT * FROM services";
      $result = Connection::connect()->prepare($query);
      $result->execute();
      $services = $result->fetchAll();
      return array("codigo" => "200", "mensaje" => "ok", "data" => $services);
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function getService($id)
  {
    try {
      $query = "SELECT * FROM services WHERE id_service = ?";
      $response = Connection::connect()->prepare($query);
      $response->bindParam(1, $id, PDO::PARAM_INT);
      $response->execute();
      $service = $response->fetch();
      $response = null;

    } catch (Exception $e) {
      return array("status" => 500, "message" => $e->getMessage());
    }
    try {
      $query = "SELECT * FROM images_services WHERE id_service = ?";
      $response = Connection::connect()->prepare($query);
      $response->bindParam(1, $id, PDO::PARAM_INT);
      $response->execute();
      $images = $response->fetchAll();
      $service['images'] = $images;
      $response = null;
    } catch (Exception $e) {
      return array("status" => 500, "message" => $e->getMessage());
    }

    return array("status" => 200, "message" => "ok", "data" => $service);
  }

  public static function createService($data)
  {
    try {
      $query = "INSERT INTO services (description_service, price_service, location_service, city_service, country_service, amount_people_service, characteristics_service, id_service_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      $connection = Connection::connect();
      $result = $connection->prepare($query);
      $result->bindParam(1, $data['description'], PDO::PARAM_STR);
      $result->bindParam(2, $data['price'], PDO::PARAM_STR);
      $result->bindParam(3, $data['location'], PDO::PARAM_STR);
      $result->bindParam(4, $data['city'], PDO::PARAM_STR);
      $result->bindParam(5, $data['country'], PDO::PARAM_STR);
      $result->bindParam(6, $data['amount'], PDO::PARAM_INT);
      $result->bindParam(7, $data['characteristics'], PDO::PARAM_STR);
      $result->bindParam(8, $data['type'], PDO::PARAM_INT);

      if ($result->execute()) {
        $serviceId = $connection->lastInsertId();
      } else {
        return array("codigo" => "500", "mensaje" => $connection->errorInfo()[2]);
      }
      
      $data['id'] = $serviceId;

      return array("codigo" => "200", "mensaje" => "ok", "data" => $data);
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function editServiceInfo($data)
  {
    try {
      $query = "UPDATE services SET description_service = ?, price_service = ?, location_service = ?, city_service = ?, country_service = ?, amount_people_service = ?, characteristics_service = ?, id_service_type = ? WHERE id_service = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $data['description'], PDO::PARAM_STR);
      $result->bindParam(2, $data['price'], PDO::PARAM_STR);
      $result->bindParam(3, $data['location'], PDO::PARAM_STR);
      $result->bindParam(4, $data['city'], PDO::PARAM_STR);
      $result->bindParam(5, $data['country'], PDO::PARAM_STR);
      $result->bindParam(6, $data['amount'], PDO::PARAM_INT);
      $result->bindParam(7, $data['characteristics'], PDO::PARAM_STR);
      $result->bindParam(8, $data['type'], PDO::PARAM_INT);
      $result->bindParam(9, $data['id'], PDO::PARAM_INT);
      $result->execute();
      return array("codigo" => "200", "mensaje" => "ok");
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function deleteService($id)
  {
    try {
      $query = "DELETE FROM services WHERE id_service = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $id, PDO::PARAM_INT);
      $result->execute();
      return array("codigo" => "200", "mensaje" => "ok");
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }
}
