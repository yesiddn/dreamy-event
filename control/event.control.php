<?php
include_once "../model/event.model.php";

class EventControl
{
  public $idEvent;
  public $nameEvent;
  public $date;
  public $address;
  public $city;
  public $country;
  public $typeEvent;
  public $customerId;

  public function createEvent()
  {
    $new = EventModel::createEvent([
      'name_event' => $this->nameEvent,
      'date' => $this->date,
      'address' => $this->address,
      'city' => $this->city,
      'country' => $this->country,
      'id_event_type' => $this->typeEvent,
      'id_customer' => $this->customerId
    ]);
    echo json_encode($new);
  }


  public function editEvent()
  {
    $edit = EventModel::editEvent($this->idEvent, $this->nameEvent, $this->date, $this->typeEvent, $this->customerId);
    echo json_encode($edit);
  }

  public function deleteEvent()
  {
    $delete = EventModel::deleteEvent($this->idEvent);
    echo json_encode($delete);
  }

  public function getEvent()
  {
    $getEvent = EventModel::getEvent();
    echo json_encode($getEvent);
  }
}

if ($_POST['action'] == 'create') {
  $new = new EventControl();
  $new->nameEvent = $_POST['event-name'];
  $new->date = $_POST['event-date'];
  $new->address = $_POST['event-address'];
  $new->city = $_POST['event-city'];
  $new->country = $_POST['event-country'];
  $new->typeEvent = $_POST['event-type'];
  $new->customerId = $_POST['idCustomer'];
  $new->createEvent();
}
