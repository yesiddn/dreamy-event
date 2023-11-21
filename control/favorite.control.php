<?php
include_once '../model/favorite.model.php';

class FavoriteServiceControl {
  public $idService;
  public $idCustomer;

  public function addFavoriteService() {
    $favoriteService = FavoriteServiceModel::addFavoriteService($this->idService, $this->idCustomer);
    echo json_encode($favoriteService);
  }

  public function readFavoriteServices() {
    $favoriteServices = FavoriteServiceModel::readFavoriteServices($this->idCustomer);
    echo json_encode($favoriteServices);
  }
}

if ($_POST['action'] == 'read') {
  $favoriteService = FavoriteServiceModel::readFavoriteServices($_POST['idCustomer']);
  echo json_encode($favoriteService);
}

if ($_POST['action'] == 'create') {
  $favoriteServiceControl = new FavoriteServiceControl();
  $favoriteServiceControl->idService = $_POST['idService'];
  $favoriteServiceControl->idCustomer = $_POST['idCustomer'];
  $favoriteServiceControl->addFavoriteService();
}