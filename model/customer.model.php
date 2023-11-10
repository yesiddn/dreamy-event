<?php
include_once 'connection.model.php';
include_once 'user.model.php';

class CustomerModel
{
  public static function createCustomer($name, $lastName, $email, $phone, $city, $country, $password, $img)
  {
    try {
      $user = UserModel::createUser($name, $lastName, $email, $phone, $city, $country, $password, $img);
      $userId = $user['id_user'];
      $file = $user['img'];

      $sql = "INSERT INTO customers (id_user) VALUES (?)";
      $connection = Connection::connect();
      $query = $connection->prepare($sql);
      $query->bindParam(1, $userId, PDO::PARAM_INT);

      if ($query->execute()) {
        $customerId = $connection->lastInsertId();
      } else {
        return $connection->errorInfo()[2];
      }

      $newCustomer = array(
        'id_customer' => $customerId,
        'name' => $name,
        'lastName' => $lastName,
        'email' => $email,
        'phone' => $phone,
        'city' => $city,
        'country' => $country,
        'img' => $file,
        'id_user' => $userId
      );

      return $newCustomer;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public static function getByEmail($email)
  {
    try {
      $response = UserModel::getByEmail($email);
      
      if (!$response) {
        return array('status' => 401, 'message' => 'User not found');
      }
      return $response;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
