<?php
include_once 'customer.model.php';

class LoginModel
{
  public static function login($email, $pass)
  {
    try {
      $customer = CustomerModel::getByEmail($email);

      if ($customer['status'] === 404) {
        return $customer;
      }

      if ($customer['data']['user']['password'] === $pass) {
        unset($customer['data']['user']['password']);
        $_SESSION['user'] = $customer['data']['user'];
        return $customer;
      } else {
        return array('status' => 401, 'message' => 'User or password incorrect');
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
