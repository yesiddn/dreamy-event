<?php
include_once '../model/events.model.php';

class EventsController {
  public $idCustomer;

  public function getEvents()
  {
    $favoriteService = EventsModel::getEvents($this->idCustomer);
    echo json_encode($favoriteService);
  }
}

if (isset($_POST["action"]) && $_POST["action"] == "read") {
  $events = new EventsController();
  $events->idCustomer = $_POST["idCustomer"];
  $events->getEvents();
}