<?php
require_once "connection.php";

class PostModel
{

   /*Peticion post para crear datos forma dinamica*/

   static public function postData($table, $data)
   {
      // echo '<pre>'; print_r($table); echo '</pre>';
      //echo '<pre>'; print_r($data); echo '</pre>';

      $columns = "";
      $params = "";

      foreach ($data as $key => $value) {
          $columns .= $key.",";
          $params .= ":".$key.",";
      }

      $columns = substr($columns, 0, -1);
      $params = substr($params, 0, -1);
     // echo '<pre>'; print_r($columns);echo '</pre>';
     // echo '<pre>'; print_r($params);echo '</pre>';

      $sql = "INSERT INTO $table($columns) VALUES ($params)";

      $link = Connection::connect();
      $stmt = $link->prepare($sql);
      
      foreach ($data as $key => $value) {
          $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);
      }
      if ($stmt->execute()) {
          $response = array(
            "lastId" => $link->lastInsertId(),
            "comment" => "Registro con exito"
          );
          return $response;
      }else{
          return $link->errorInfo();
      }

   }
}
