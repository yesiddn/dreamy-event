<?php
include_once 'model/connection.model.php';
include_once 'model/user.model.php';

class CustomerModel {
  public static function createCustomer($name, $lastName, $email, $phone, $city, $country, $password, $img) {
    $user = UserModel::createUser($name, $lastName, $email, $phone, $city, $country, $password, $img);
    $userId = $user['id'];

    $sql = "INSERT INTO customers (user_id) VALUES (?); SELECT LAST_INSERT_ID();";
    $query = conexion::conectar()->prepare($sql);
    $query->bindParam(1, $userId, PDO::PARAM_INT);
    $customerId = $query->execute();

    $customer = array(
      'id' => $customerId,
      'name' => $name,
      'lastName' => $lastName,
      'email' => $email,
      'phone' => $phone,
      'city' => $city,
      'country' => $country,
      'img' => $img,
      'user_id' => $userId
    );

    return $customer;
  }
}