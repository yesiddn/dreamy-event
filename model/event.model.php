<?php

include_once "connection.model.php";

class EventModel
{

 public static function createEvent($data){
    try {
        $query = "INSERT INTO events (name_event,date,id_event_type,id_customer) VALUES (?,?,?,?)";
        $connection = Connection::connect();
        $result = $connection->prepare($query);
        $result->bindParam(1, $data['name_event'], PDO::PARAM_STR);
        $result->bindParam(2, $data['date'], PDO::PARAM_STR);
        $result->bindParam(3, $data['id_event_type'], PDO::PARAM_INT);
        $result->bindParam(4, $data['id_customer'], PDO::PARAM_INT);

        if ($result->execute()) {
            return array("codigo" => "200", "mensaje" => "ok");
        } else {
            return array("codigo" => "500", "mensaje" => $connection->errorInfo()[2]);
        }

    } catch (Exception $e) {
         return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
   
 }


 public static function editEvent($data)
 {
    try {
        $query = "UPDATE events SET name_event = ?, date = ?, id_event_type = ?, id_customer = ? WHERE id_event = ?";
        $result = Connection::connect()->prepare($query);
        $result->bindParam(1, $data['name'], PDO::PARAM_STR);
        $Date = $data['date']->format('Y-m-d H:i:s');
        $result->bindParam(2, $Date, PDO::PARAM_STR);
        $result->bindParam(3, $data['id_event_type'], PDO::PARAM_INT);
        $result->bindParam(4, $data['id_customer'], PDO::PARAM_INT);
        $result->execute();
        return array("codigo" => "200", "mensaje" => "ok");
    } catch (Exception $e) {
        return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
 }

 public static function deleteEvent($id)
 {
    try {
        $query = "DELETE FROM events WHERE id_event = ?";
        $result = Connection::connect()->prepare($query);
        $result->bindParam(1, $id, PDO::PARAM_INT);
        $result->execute();
        return array("codigo" => "200", "mensaje" => "ok");
    } catch (Exception $e) {
        return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
 } 

 public static function getEvent()
 {
    try {
        $query = "SELECT * FROM events";
        $result = Connection::connect()->prepare($query);
        $result->execute();
        $event = $result->fetchAll();
        return array("codigo" => "200", "mensaje" => "ok", "data" => $event);
    } catch (Exception $e) {
        return array("codigo" => "500", "mensaje" => $e->getMessage());
    }
 }

}
