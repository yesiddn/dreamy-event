<?php
include_once 'customer.model.php';
include_once 'supplier.model.php';

class LoginModel
{
  public static function login($email)
  {
    try {
      $customer = CustomerModel::getByEmail($email);

      if ($customer['status'] === 404) {
        return $customer;
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }

    /*
    try {
      $supplier = SupplierModel::getSupplier($customer['data']['user']['id_user']);

      if ($supplier['status'] === 404) {
        return $customer;
      }

      $customer['data']['supplier'] = $supplier['data'];
      $_SESSION['supplier'] = $supplier['data'];
    } catch (Exception $e) {
      return $e->getMessage();
    } */
    return $customer;
  }
}
