<?php
include_once '../model/events.model.php';

class EventsController {
  public $idEvent;
  public $idService;
  public $idCustomer;

  public function getEvents()
  {
    $favoriteService = EventsModel::getEvents($this->idCustomer);
    echo json_encode($favoriteService);
  }

  public function addServiceToEvent() {
    $response = EventsModel::addServiceToEvent($this->idEvent, $this->idService);
    echo json_encode($response);
  }

  public function deleteEvent() {
    $response = EventsModel::deleteEvent($this->idEvent);
    echo json_encode($response);
  }
}

if (isset($_POST["action"]) && $_POST["action"] == "read") {
  $events = new EventsController();
  $events->idCustomer = $_POST["idCustomer"];
  $events->getEvents();
} 

if (isset($_POST["action"]) && $_POST["action"] == "addService") {
  $events = new EventsController();
  $events->idEvent = $_POST["idEvent"];
  $events->idService = $_POST["idService"];
  $events->addServiceToEvent();
}

if (isset($_POST["action"]) && $_POST["action"] == "delete") {
  $events = new EventsController();
  $events->idEvent = $_POST["idEvent"];
  $events->deleteEvent();
}