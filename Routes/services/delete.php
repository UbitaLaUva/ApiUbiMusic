<?php
require_once "Models/connection.php";
require_once "Controllers/DeleteController.php";

if (isset($_GET["id"]) && isset($_GET["nameId"])) {
    
    $columns = array($_GET["nameId"]);

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
    /*Se solicita respuesta al controlador para eliminar datos en cualquier tabla*/
    $response = new DeleteController();
    $response->deleteData($table,$_GET["id"], $_GET["nameId"]);
}
