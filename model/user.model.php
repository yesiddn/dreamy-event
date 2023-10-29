<?php

include_once 'connection.model.php';
include_once 'files.model.php';

class UserModel
{
  public static function createUser($name, $lastName, $email, $phone, $city, $country, $password, $file)
  {
    try {
      $img = FilesModel::saveImage($file);

      $sql = "INSERT INTO users (name_user, last_name_user, email_user, phone_user, city_user, country_user, password_user, img_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      $connection = Connection::connect();
      $query = $connection->prepare($sql);
      $query->bindParam(1, $name, PDO::PARAM_STR);
      $query->bindParam(2, $lastName, PDO::PARAM_STR);
      $query->bindParam(3, $email, PDO::PARAM_STR);
      $query->bindParam(4, $phone, PDO::PARAM_STR);
      $query->bindParam(5, $city, PDO::PARAM_STR);
      $query->bindParam(6, $country, PDO::PARAM_STR);
      $query->bindParam(7, $password, PDO::PARAM_STR);
      $query->bindParam(8, $img, PDO::PARAM_STR);

      if ($query->execute()){
        $userId = $connection->lastInsertId();
      } else {
        return $connection->errorInfo()[2];
      }

      $user = array(
        'id_user' => $userId,
        'name' => $name,
        'lastName' => $lastName,
        'email' => $email,
        'phone' => $phone,
        'city' => $city,
        'country' => $country,
        'img' => $img
      );

      return $user;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public static function getByEmail($email)
  {
    try {
      $sql = "SELECT * FROM users WHERE email_user = ?";
      $connection = Connection::connect();
      $query = $connection->prepare($sql);
      $query->bindParam(1, $email, PDO::PARAM_STR);
      $query->execute();
      $user = $query->fetch(PDO::FETCH_ASSOC);

      if ($user) {
        return $user;
      }

      return array(
        'status' => 404,
        'message' => 'User not found',
      );
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
