<?php
include_once 'connection.model.php';

class EventsModel {
  public static function getEvents($idCustomer) {
    $sql = "SELECT events.id_event, events.name_event, events.date, events.id_event_type, events.id_customer, COUNT(event_has_services.id_service) AS amountServices, SUM(services.price) AS total FROM events INNER JOIN event_has_services ON events.id_event = event_has_services.id_event INNER JOIN services ON event_has_services.id_service = services.id_service WHERE events.id_customer = ? ORDER BY date DESC;";

    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $idCustomer, PDO::PARAM_INT);
    $query->execute();
    $response = $query->fetchAll(PDO::FETCH_ASSOC);
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
}