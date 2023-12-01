<?php
include_once "../model/event.model.php";

class EventControl{
    public $idEvent;
    public $nameEvent;
    public $date;
    public $typeEvent;
    public $customerId;

    public function createEvent() {
                $new = EventModel::createEvent([
                  'name_event' => $this->nameEvent,
                  'date' => $this->date,
                  'id_event_type' => $this->typeEvent,
                  'id_customer' => $this->customerId
                ]);
                echo json_encode($new);
            }
    

    public function editEvent(){
        $edit = EventModel::editEvent($this->idEvent,$this->nameEvent,$this->date,$this->typeEvent,$this->customer);
        echo json_encode($edit);
    }

    public function deleteEvent(){
        $delete = EventModel::deleteEvent($this->idEvent);
        echo json_encode($delete);
    }

    public function getEvent(){
        $getEvent = EventModel::getEvent();
        echo json_encode($getEvent);
    }

}

if (isset($_POST['event-name'],$_POST['event-date'],$_POST['event-type'],$_POST['idCustomer'])) {
    $new = new EventControl();
    $new->nameEvent = $_POST['event-name'];
    $new->date = $_POST['event-date'];
    $new->typeEvent = $_POST['event-type'];
    $new->customerId = $_POST['idCustomer'];
    $new->createEvent();
}




