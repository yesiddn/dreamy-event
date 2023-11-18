<?php
include_once 'connection.model.php';
include_once 'files.model.php';

class UserModel
{
  public static function createUser($email, $password)
  {
    try {
      $sql = "INSERT INTO users (email_user,password_user) VALUES (?, ?)";
      $connection = Connection::connect();
      $query = $connection->prepare($sql);
      $query->bindParam(1, $email, PDO::PARAM_STR);
      $query->bindParam(2, $password, PDO::PARAM_STR);

      if ($query->execute()){
        $userId = $connection->lastInsertId();
      } else {
        return $connection->errorInfo()[2];
      }

      $user = array(
        'status' => 201,
        'message' => 'User created successfully',
        'data' => array(
          'id_user' => $userId,
          'email' => $email
        )
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
        return array('status' => 200, 'message' => 'User found', 'data' => $user);
      }

      return array(
        'status' => 404,
        'message' => 'User not found',
        'data' => null
      );
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
