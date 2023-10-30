<?php
class FIlesModel {
  public static function saveImage($file) {
    $fileName = $file['name'];
    $rout = '../userFiles/';
    $mainRout = "userFiles/" . $fileName;
    $extention = strtoupper(substr($fileName, -4));
    
    // Verificamos que el archivo sea una imagen
    if ($extention == ".JPG" || $extention == ".PNG" || $extention == "JPEG") {
      
      // Movemos el archivo al directorio de destino
      if (move_uploaded_file($file['tmp_name'], $rout . $fileName)) {
        return $mainRout;
      } else {
        return array("codigo" => "404", "mensaje" => "error al subir el archivo");
      }
    } else {
      return array("codigo" => "404", "mensaje" => "el tipo de archivo no es compatible las extenciones permitidas son jpg,png y jpeg.");
    }
  }
}
