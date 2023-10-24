<?php
class conexion
{
  public static function conectar()
  {
    $nombreServidor = "localhost";
    $baseDatos = "dreamy_event";
    $usuario = "root";
    $password = "";

    try {
      $objConexion = new PDO('mysql:host=' . $nombreServidor . ';dbname=' . $baseDatos . ';', $usuario, $password);
      $objConexion->exec("set names utf8");
    } catch (Exception $e) {
      $objConexion = $e;
    }
    return $objConexion;
  }
}
