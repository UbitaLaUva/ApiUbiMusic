<?php
require_once "Models/connection.php";
require_once "Controllers/PutController.php";

if (isset($_GET["id"]) && isset($_GET["nameId"])) {
    $data = array();
    parse_str(file_get_contents('php://input'), $data);
  //  echo '<pre>'; print_r($data); echo '</pre>';

    $columns = array();
    foreach (array_keys($data) as $key => $value) {
        array_push($columns, $value);
    }
  //  echo '<pre>'; print_r($columns); echo '</pre>';

    /*Validar tablas y columnas*/

    if (empty(Connection::getColumnsData($table, $columns))) {

        $json = array(
            'status' => 404,
            'results' => "Error no se encuentran las tablas en la base de datos"
        );
        echo json_encode($json, http_response_code($json["status"]));
       return;
    }
     /*Se solicita respuesta al controlador para editar datos en cualquier tabla*/
     $response = new PutController();
     $response -> putData($table, $data,$_GET["id"], $_GET["nameId"]);

}