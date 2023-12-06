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

  public static function getEventById($idEvent) {
    $sql = "SELECT * FROM events WHERE id_event = ?;";

    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $idEvent, PDO::PARAM_INT);
    $query->execute();
    $response = $query->fetch();
    $query = null;

    if (!$response) {
      return array(
        'status' => 404,
        'message' => 'Event not found',
        'data' => null
      );
    }

    $event = array(
      'idEvent' => $response['id_event'],
      'name' => $response['name_event'],
      'date' => $response['date'],
      'address' => $response['address'],
      'city' => $response['city'],
      'country' => $response['country'],
      'idEventType' => $response['id_event_type'],
      'idCustomer' => $response['id_customer'],
    );

    return array(
      'status' => 200,
      'message' => 'Event found',
      'data' => $event
    );
  }

  public static function getEventResume($idEvent) {
    $sql = "SELECT services.name_service, services.price FROM services INNER JOIN event_has_services ON services.id_service = event_has_services.id_service WHERE event_has_services.id_event = ?;";

    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $idEvent, PDO::PARAM_INT);
    $query->execute();
    $response = $query->fetchAll();
    $query = null;

    if (!$response) {
      return array(
        'status' => 404,
        'message' => 'Services not found',
        'data' => null
      );
    }

    $data = array();

    $data["services"] = $response;

    $total = self::getTotal($response);
    $referenceCode = self::generateReferenceCode($total, 'yesidrodriguez305@gmail.com', $idEvent);

    $data["checkoutData"] = array(
      'merchantId' => '508029',
      'accountId' => '512321',
      'description' => 'Pago por servicios de evento.',
      'referenceCode' => $referenceCode,
      'amount' => $total,
      'extra1' => $idEvent,
      'tax' => '0',
      'taxReturnBase' => '0',
      'currency' => 'COP',
      'signature' => self::generateSignature('508029', $referenceCode, $total, 'COP'),
      'test' => '0',
      'responseUrl' => 'http://192.168.0.42/dreamy-event/response-checkout',
    );

    return array(
      'status' => 200,
      'message' => 'Services found',
      'data' => $data
    );
  }

  public static function getTotal($services) {
    $total = 0;

    foreach ($services as $service) {
      $total += $service['price'];
    }

    return $total;
  }

  public static function generateReferenceCode($total, $buyerEmail, $idEvent) {
    $referenceCode = md5("$total~$buyerEmail~$idEvent");

    return $referenceCode;
  }

  public static function generateSignature($merchantId, $referenceCode, $amount, $currency) {
    $apiKey = '4Vj8eK4rloUd272L48hsrarnUA';
    $signature = md5("$apiKey~$merchantId~$referenceCode~$amount~$currency");

    return $signature;
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

  public static function updateEvent($idEvent, $name, $date, $addres, $city, $country, $typeEvent) {
    $sql = "UPDATE events SET name_event = ?, date = ?, address = ?, city = ?, country = ?, id_event_type = ? WHERE id_event = ?;";

    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $name, PDO::PARAM_STR);
    $query->bindParam(2, $date, PDO::PARAM_STR);
    $query->bindParam(3, $addres, PDO::PARAM_STR);
    $query->bindParam(4, $city, PDO::PARAM_STR);
    $query->bindParam(5, $country, PDO::PARAM_STR);
    $query->bindParam(6, $typeEvent, PDO::PARAM_INT);
    $query->bindParam(7, $idEvent, PDO::PARAM_INT);
    $response = $query->execute();
    $query = null;

    if (!$response) {
      return array(
        'status' => 400,
        'message' => 'Event not updated',
        'data' => null
      );
    }

    return array(
      'status' => 200,
      'message' => 'Event updated',
      'data' => array(
        'idEvent' => $idEvent,
        'name' => $name,
        'date' => $date,
        'address' => $addres,
        'city' => $city,
        'country' => $country,
        'idEventType' => $typeEvent
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

  public static function deleteEventService($idEvent, $idService) {
    $sql = "DELETE FROM event_has_services WHERE id_event = ? AND id_service = ?;";

    $query = Connection::connect()->prepare($sql);
    $query->bindParam(1, $idEvent, PDO::PARAM_INT);
    $query->bindParam(2, $idService, PDO::PARAM_INT);
    $response = $query->execute();
    $query = null;

    if (!$response) {
      return array(
        'status' => 400,
        'message' => 'Service not deleted',
        'data' => null
      );
    }

    return array(
      'status' => 200,
      'message' => 'Service deleted',
      'data' => array(
        'idEvent' => $idEvent,
        'idService' => $idService
      )
    );
  }
}