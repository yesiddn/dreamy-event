<?php
include_once 'model/connection.model.php';

class UserModel {
  public static function createUser($name, $lastName, $email, $phone, $city, $country, $password, $img) {
    $sql = "INSERT INTO users (name, lastName, email, phone, city, country, password, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?); SELECT LAST_INSERT_ID();";
    $query = conexion::conectar()->prepare($sql);
    $query->bindParam(1, $name, PDO::PARAM_STR);
    $query->bindParam(2, $lastName, PDO::PARAM_STR);
    $query->bindParam(3, $email, PDO::PARAM_STR);
    $query->bindParam(4, $phone, PDO::PARAM_STR);
    $query->bindParam(5, $city, PDO::PARAM_STR);
    $query->bindParam(6, $country, PDO::PARAM_STR);
    $query->bindParam(7, $password, PDO::PARAM_STR);
    $query->bindParam(8, $img, PDO::PARAM_STR);
    $userId = $query->execute();

    $user = array(
      'id' => $userId,
      'name' => $name,
      'lastName' => $lastName,
      'email' => $email,
      'phone' => $phone,
      'city' => $city,
      'country' => $country,
      'img' => $img
    );

    return $user;
  }
}