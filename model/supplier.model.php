<?php
include_once 'connection.model.php';
include_once 'user.model.php';

class SupplierModel
{
  public static function createSupplier($name, $email, $phone, $rut, $city, $country, $img, $userId)
  {
    try {
      $supplierExists = self::getSupplierByEmail($email);

      if ($supplierExists['data'] != null) {
        return array('status' => 409, 'message' => 'Supplier already exists');
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }

    try {
      $imgUrl = FilesModel::saveImage($img);

      $sql = "INSERT INTO suppliers (name_company, email_company, phone_company, rut_company, city_company, country_company, image_company, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      $connection = Connection::connect();
      $query = $connection->prepare($sql);
      $query->bindParam(1, $name, PDO::PARAM_STR);
      $query->bindParam(2, $email, PDO::PARAM_STR);
      $query->bindParam(3, $phone, PDO::PARAM_STR);
      $query->bindParam(4, $rut, PDO::PARAM_STR);
      $query->bindParam(5, $city, PDO::PARAM_STR);
      $query->bindParam(6, $country, PDO::PARAM_STR);
      $query->bindParam(7, $imgUrl, PDO::PARAM_STR);
      $query->bindParam(8, $userId, PDO::PARAM_INT);

      if ($query->execute()) {
        $supplierId = $connection->lastInsertId();
      } else {
        return $connection->errorInfo()[2];
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }

    $newSupplier = array(
      'status' => 201,
      'message' => 'Customer created successfully',
      'data' => array(
        'id_supplier' => $supplierId,
        'name_compny' => $name,
        'email_company' => $email,
        'phone_company' => $phone,
        'rut_company' => $rut,
        'city_company' => $city,
        'country_company' => $country,
        'image_company' => $imgUrl,
        'id_user' => $userId
      )
    );

    $_SESSION['supplier'] = $newSupplier['data'];

    return $newSupplier;
  }

  public static function getSupplierByEmail($email)
  {
    try {
      $sql = "SELECT * FROM suppliers WHERE email_company = ?";
      $query = Connection::connect()->prepare($sql);
      $query->bindParam(1, $email, PDO::PARAM_STR);
      $query->execute();
      $customer = $query->fetch(PDO::FETCH_ASSOC);

      return array(
        'status' => 200,
        'message' => 'Customer found',
        'data' => $customer
      );
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
