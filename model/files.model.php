<?php
class FilesModel {
  public static function saveImage($file) {
    $fileName = $file['name'];
    $rout = '../userFiles/';
    $mainRout = "userFiles/" . $fileName;
    $extention = strtoupper(substr($fileName, -4));
    
    // Verificamos que el archivo sea una imagen
    if ($extention == ".JPG" || $extention == ".PNG" || $extention == "JPEG") {
      // Verificamos que la carpeta destino exista, si no la creamos
      // if (!file_exists($mainRout)) {
      //   mkdir($rout, 0777, true);
      // }

      // Movemos el archivo al directorio de destino
      if (move_uploaded_file($file['tmp_name'], $rout . $fileName)) {
        return $mainRout;
      } else {
        return array("codigo" => "404", "mensaje" => "Error al subir el archivo");
      }
    } else {
      return array("codigo" => "404", "mensaje" => "El tipo de archivo no es compatible las extenciones permitidas son jpg,png o jpeg.");
    }
  }

  public static function saveImageInDB($idService, $imageRout) {
    try {
      $query = "INSERT INTO images_services (url_image, id_service) VALUES (?, ?)";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $imageRout, PDO::PARAM_STR);
      $result->bindParam(2, $idService, PDO::PARAM_INT);
      $result->execute();
      return array("codigo" => "200", "mensaje" => "Ok");
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function createServiceImages($idService, $files) {
    try {
      $imagesRout = array();
      foreach ($files as $file) {
        $imageRout = self::saveImage($file);
        
        if (is_array($imageRout)) {
          return $imageRout;
        }

        array_push($imagesRout, $imageRout);
      }
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }

    try {
      foreach ($imagesRout as $imageRout) {
        $result = self::saveImageInDB($idService, $imageRout);
        if ($result['codigo'] != "200") {
          return $result;
        }
      }

      return array("codigo" => "200", "mensaje" => "Ok", "data" => $imagesRout);
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function getServiceImaes($idService) {
    try {
      $query = "SELECT * FROM images_services WHERE id_image_service = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $idService, PDO::PARAM_INT);
      $result->execute();
      $serviceImages = $result->fetchAll();
      return array("codigo" => "200", "mensaje" => "Ok", "data" => $serviceImages);
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function deleteServiceImage($idImage) {
    try {
      $query = "DELETE FROM images_services WHERE id_image_service = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $idImage, PDO::PARAM_INT);
      $result->execute();
      return array("codigo" => "200", "mensaje" => "Ok");
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }

  public static function deleteServiceImageBySupplierId($idSupplier) {
    try {
      $query = "DELETE FROM images_services WHERE id_supplier = ?";
      $result = Connection::connect()->prepare($query);
      $result->bindParam(1, $idSupplier, PDO::PARAM_INT);
      $result->execute();
      return array("codigo" => "200", "mensaje" => "Ok");
    } catch (Exception $e) {
      return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
  }
}
