<?php
include_once 'connection.model.php';
include_once 'user.model.php';

class CustomerModel
{
  public static function createCustomer($name, $lastName, $email, $phone, $city, $country, $password, $img, $eventId)
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

      if ($response['data'] == null) {
        return array('status' => 404, 'message' => 'User not found');
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }

    try {
      $sql = "SELECT * FROM customers WHERE id_user = ?";
      $connection = Connection::connect();
      $query = $connection->prepare($sql);
      $query->bindParam(1, $response['data']['id_user'], PDO::PARAM_INT);
      $query->execute();
      $customer = $query->fetch(PDO::FETCH_ASSOC);

      if ($customer) {
        $customerData = CustomerModel::orderCustomerData($customer, $response['data']);
        return array('status' => 200, 'message' => 'Customer found', 'data' => $customerData);
      }

      return array(
        'status' => 404,
        'message' => 'Customer not found',
        'data' => null
      );
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public static function orderCustomerData($customerData, $userData)
  {
    $data = array(
      'id_customer' => $customerData['id_customer'],
      'name' => $customerData['name_customer'],
      'last_name' => $customerData['last_name_customer'],
      'phone' => $customerData['phone_customer'],
      'city' => $customerData['city_customer'],
      'country' => $customerData['country_customer'],
      'img_profile' => $customerData['img_profile_customer'],
      'user' => array(
        'id_user' => $userData['id_user'],
        'email' => $userData['email_user'],
        'password' => $userData['password_user']
      )
    );

    return $data;
  }
}
