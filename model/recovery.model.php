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
    $Code = UserModel::userInsertionCode($email,$randomCode);
    $recoveryEmailContent = ResetCodeEmail::emailResetConfirmation($email,$randomCode);

    return $User;
  }
}
