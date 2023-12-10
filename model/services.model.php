<?php
include_once 'connection.model.php';

class ServicesModel
{
  public static function getServices($idCustomer)
  {
    try {
      if ($idCustomer == "null") {
        $query = "SELECT services.id_service, services.name_service, services.description_service, services.price, services.location, services.city, services.country, services.amount_people, services.characteristics, ROUND(AVG(COALESCE(comments.calificacion_comentario, 0)), 1) AS rating, services.id_type_service, services.id_supplier, images_services.id_image, images_services.url_image FROM services INNER JOIN images_services ON services.id_service = images_services.id_service LEFT JOIN comments ON comments.id_servicio = services.id_service GROUP BY comments.id_servicio;";
        $result = Connection::connect()->prepare($query);
      } else {
        $query = "SELECT services.id_service, services.name_service, services.description_service, services.price, services.location, services.city, services.country, services.amount_people, services.characteristics, ROUND(AVG(COALESCE(comments.calificacion_comentario, 0)), 1) AS rating, services.id_type_service, services.id_supplier, images_services.id_image, images_services.url_image, favorites.id_customer AS is_favorite FROM services INNER JOIN images_services ON services.id_service = images_services.id_service LEFT JOIN favorites ON services.id_service = favorites.id_service AND favorites.id_customer = ? LEFT JOIN comments ON comments.id_servicio = services.id_service GROUP BY comments.id_servicio;";
        $result = Connection::connect()->prepare($query);
        $result->bindParam(1, $idCustomer, PDO::PARAM_INT);
      }

      $result->execute();
      $services = $result->fetchAll();
      $result = null;

      return array("codigo" => "200", "mensaje" => "ok", "data" => $services);
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function getServicesSupplier($idSupplier)
  {
    try {
        $query = "SELECT services.id_service, services.name_service, services.description_service, services.price, services.location, services.city,
        services.country,services.amount_people, services.characteristics, services.id_type_service, services.id_supplier,
        suppliers.name_company, users.id_user, customers.id_customer, images_services.id_image, images_services.url_image
        FROM services INNER JOIN images_services ON services.id_service = images_services.id_service 
        INNER JOIN suppliers ON suppliers.id_supplier = services.id_supplier 
        INNER JOIN users ON users.id_user = suppliers.id_user 
        LEFT JOIN customers ON customers.id_user = users.id_user
        WHERE services.id_supplier = suppliers.id_supplier AND customers.id_customer = ?";
        $result = Connection::connect()->prepare($query);
        $result->bindParam(1, $idSupplier, PDO::PARAM_INT);
        $result->execute();
        $services = $result->fetchAll();
        $result = null;
      
      return array("codigo" => "200", "mensaje" => "ok", "data" => $services);
    } catch (Exception $e) {
      echo json_encode(array("codigo" => "500", "mensaje" => $e->getMessage()));
    }
  }


  public static function getService($id)
  {
    try {
      $query = "SELECT services.*, COALESCE(ROUND(AVG(comments.calificacion_comentario), 1), 0) AS rating FROM services LEFT JOIN comments ON comments.id_servicio = services.id_service WHERE id_service = ?";
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

  public static function getEventServices($idEvent)
  {
    try {
      $query = "SELECT services.id_service, services.name_service, services.description_service, services.price, services.location, services.city, services.country, services.amount_people, services.characteristics, services.id_type_service, services.id_supplier, images_services.id_image, images_services.url_image FROM services INNER JOIN images_services ON services.id_service = images_services.id_service INNER JOIN event_has_services ON services.id_service = event_has_services.id_service WHERE event_has_services.id_event = ? GROUP BY services.id_service";
      $response = Connection::connect()->prepare($query);
      $response->bindParam(1, $idEvent, PDO::PARAM_INT);
      $response->execute();
      $services = $response->fetchAll();
      $response = null;
    } catch (Exception $e) {
      return array("status" => 500, "message" => $e->getMessage());
    }

    return array("status" => 200, "message" => "ok", "data" => $services);
  }

  public static function getServicesByType($idCustomer, $idTypeService)
  {
    try {
      if ($idCustomer == "null") {
        $query = "SELECT services.id_service, services.name_service, services.description_service, services.price, services.location, services.city, services.country, services.amount_people, services.characteristics, ROUND(AVG(COALESCE(comments.calificacion_comentario, 0)), 1) AS rating, services.id_type_service, services.id_supplier, images_services.id_image, images_services.url_image FROM services INNER JOIN images_services ON services.id_service = images_services.id_service LEFT JOIN comments ON comments.id_servicio = services.id_service WHERE services.id_type_service = ? GROUP BY comments.id_servicio;";
        $result = Connection::connect()->prepare($query);
        $result->bindParam(1, $idTypeService, PDO::PARAM_INT);
      } else {
        $query = "SELECT services.id_service, services.name_service, services.description_service, services.price, services.location, services.city, services.country, services.amount_people, services.characteristics, ROUND(AVG(COALESCE(comments.calificacion_comentario, 0)), 1) AS rating, services.id_type_service, services.id_supplier, images_services.id_image, images_services.url_image, favorites.id_customer AS is_favorite FROM services INNER JOIN images_services ON services.id_service = images_services.id_service LEFT JOIN favorites ON services.id_service = favorites.id_service AND favorites.id_customer = ? LEFT JOIN comments ON comments.id_servicio = services.id_service WHERE services.id_type_service = ? GROUP BY comments.id_servicio;";
        $result = Connection::connect()->prepare($query);
        $result->bindParam(1, $idCustomer, PDO::PARAM_INT);
        $result->bindParam(2, $idTypeService, PDO::PARAM_INT);
      }

      $result->execute();
      $services = $result->fetchAll();
      $result = null;

      return array("codigo" => "200", "mensaje" => "ok", "data" => $services);
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function createService($data)
  {
    try {
      $query = "INSERT INTO services (name_service, description_service, price, location, city, country, amount_people, characteristics, id_type_service, id_supplier) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $connection = Connection::connect();
      $result = $connection->prepare($query);

      $result->bindParam(1, $data['name'], PDO::PARAM_STR);
      $result->bindParam(2, $data['description'], PDO::PARAM_STR);
      $result->bindParam(3, $data['price'], PDO::PARAM_STR);
      $result->bindParam(4, $data['location'], PDO::PARAM_STR);
      $result->bindParam(5, $data['city'], PDO::PARAM_STR);
      $result->bindParam(6, $data['country'], PDO::PARAM_STR);
      $result->bindParam(7, $data['amount'], PDO::PARAM_INT);
      $result->bindParam(8, $data['characteristics'], PDO::PARAM_STR);
      $result->bindParam(9, $data['id_type_service'], PDO::PARAM_INT);
      $result->bindParam(10, $data['id_supplier'], PDO::PARAM_INT);

      if ($result->execute()) {
        $serviceId = $connection->lastInsertId();
        $data['id'] = $serviceId;
        return array("codigo" => "200", "mensaje" => "ok", "data" => $data);
      } else {
        return array("codigo" => "500", "mensaje" => $connection->errorInfo()[2]);
      }    
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
