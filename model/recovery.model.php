<?php
include_once 'user.model.php';
include_once 'recovery-code-email.model.php';

class LoginModel
{
  public static function login($email)
  {

    try {
      $User = UserModel::getByEmail($email);

      if ($User['status'] === 404) {
        return $User;
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }

    /* generacion y envio de un codigo random */
    $randomCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $Code = UserModel::userInsertionCode($email, $randomCode);
    $recoveryEmailContent = ResetCodeEmail::emailResetConfirmation($email, $randomCode);

    return $User;
  }

  public static function codeValidation($code)
  {
    try {
      $sql = "SELECT * FROM users WHERE recovery_code = ?";
      $connection = Connection::connect();
      $query = $connection->prepare($sql);
      $query->bindParam(1, $code, PDO::PARAM_STR);
      $query->execute();
      $user = $query->fetch(PDO::FETCH_ASSOC);

      if ($user) {
        return array('status' => 200, 'message' => 'Code generated', 'data' => $user);
      }

      return array(
        'status' => 404,
        'message' => 'something went wrong',
        'data' => null
      );
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }


  public static function setNewPassword($password,$user_id)
  {

    try {
      $sql = "UPDATE users SET password_user = ?,recovery_code = NULL WHERE id_user = ?";
      $connection = Connection::connect();
      $query = $connection->prepare($sql);
      $query->bindParam(1, $password, PDO::PARAM_STR);
      $query->bindParam(2, $user_id, PDO::PARAM_STR);
      $query->execute();

      if ($query) {
        return array('status' => 200, 'message' => 'Password Changed', 'data' => $query);
      }

      return array(
        'status' => 400,
        'message' => 'Password Change Failed',
        'data' => null
      );
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  
}
