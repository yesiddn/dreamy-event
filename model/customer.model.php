<?php
include_once 'connection.model.php';
include_once 'user.model.php';

class CustomerModel
{
  public static function createCustomer($name, $lastName, $email, $phone, $city, $country, $password, $img)
  {
    try {
      $userExist = UserModel::getByEmail($email);

      if ($userExist['data'] != null) {
        return array('status' => 409, 'message' => 'User already exists');
      }

      $response = UserModel::createUser($email, $password);
      $user = $response['data'];
    } catch (Exception $e) {
      return $e->getMessage();
    }

    try {
      $img = FilesModel::saveImage($img);

      $sql = "INSERT INTO customers (name_customer, last_name_customer, phone_customer, city_customer, country_customer, img_profile_customer, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $connection = Connection::connect();
      $query = $connection->prepare($sql);
      $query->bindParam(1, $name, PDO::PARAM_STR);
      $query->bindParam(2, $lastName, PDO::PARAM_STR);
      $query->bindParam(3, $phone, PDO::PARAM_STR);
      $query->bindParam(4, $city, PDO::PARAM_STR);
      $query->bindParam(5, $country, PDO::PARAM_STR);
      $query->bindParam(6, $img, PDO::PARAM_STR);
      $query->bindParam(7, $user['id_user'], PDO::PARAM_INT);

      if ($query->execute()) {
        $customerId = $connection->lastInsertId();
      } else {
        return $connection->errorInfo()[2];
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }

    $newCustomer = array(
      'status' => 201,
      'message' => 'Customer created successfully',
      'data' => array(
        'id_customer' => $customerId,
        'name' => $name,
        'last_name' => $lastName,
        'phone' => $phone,
        'city' => $city,
        'country' => $country,
        'img_profile' => $img,
        'user' => $user
      )
    );

    $_SESSION['user'] = $newCustomer['data']['user'];

    return $newCustomer;
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
