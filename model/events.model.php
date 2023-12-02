<?php
include_once 'connection.model.php';

class EventsModel {
  public static function getEvents($idCustomer) {
    $sql = "SELECT events.id_event, events.name_event, events.date, events.id_event_type, events.id_customer, COUNT(event_has_services.id_service) AS amountServices, SUM(services.price) AS total FROM events LEFT JOIN event_has_services ON event_has_services.id_event = events.id_event LEFT JOIN services ON event_has_services.id_service = services.id_service WHERE events.id_customer = ? GROUP BY events.id_event ORDER BY date DESC;";

    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $idCustomer, PDO::PARAM_INT);
    $query->execute();
    $response = $query->fetchAll();
    $query = null;

    if (!$response) {
      return array(
        'status' => 404,
        'message' => 'Events not found',
        'data' => null
      );
    }

    $events = self::orderEventsData($response);

    return array(
      'status' => 200,
      'message' => 'Events found',
      'data' => $events
    );
  }

  public static function addServiceToEvent($idEvent, $idService) {
    $sql = "INSERT INTO event_has_services (id_event, id_service) VALUES (?, ?);";

    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $idEvent, PDO::PARAM_INT);
    $query->bindParam(2, $idService, PDO::PARAM_INT);
    $response = $query->execute();
    $query = null;

    if (!$response) {
      return array(
        'status' => 400,
        'message' => 'Service not added',
        'data' => null
      );
    }

    return array(
      'status' => 201,
      'message' => 'Service added',
      'data' => array(
        'idEvent' => $idEvent,
        'idService' => $idService
      )
    );
  }

  public static function orderEventsData($eventData) {
    $data = array();

    foreach ($eventData as $event) {
      $eventData = array(
        'idEvent' => $event['id_event'],
        'name' => $event['name_event'],
        'date' => $event['date'],
        'idEventType' => $event['id_event_type'],
        'idCustomer' => $event['id_customer'],
        'amountServices' => $event['amountServices'],
        'total' => $event['total']
      );

      array_push($data, $eventData);
    }

    return $data;
  }

  public static function deleteEvent($idEvent) {
    $sql = "DELETE FROM events WHERE id_event = ?;";

    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $idEvent, PDO::PARAM_INT);
    $response = $query->execute();
    $query = null;

    if (!$response) {
      return array(
        'status' => 400,
        'message' => 'Event not deleted',
        'data' => null
      );
    }

    return array(
      'status' => 200,
      'message' => 'Event deleted',
      'data' => array(
        'idEvent' => $idEvent
      )
    );
  }
}