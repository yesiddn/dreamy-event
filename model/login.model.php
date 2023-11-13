<?php
include_once 'customer.model.php';

class LoginModel {
  public static function login($email, $pass) {
    try {
      $customer = CustomerModel::getByEmail($email);

      if ($customer['status'] === 401 || $customer['status'] === 404) {
        return $customer;
      }

      if ($customer['data']['password_user'] === $pass) {
        $_SESSION['id_customer'] = $customer['data']['id_user'];
        unset($customer['data']['password_user']);
        return $customer;
      } else {
        return array('status' => 401, 'message' => 'User or password incorrect');
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}