<?php

require_once "Models/connection.php";
require_once "Controllers/PostController.php";

if (isset($_POST)) {

    $columns = array();
    foreach (array_keys($_POST) as $key => $value) {
        array_push($columns, $value);
    }
    // echo '<pre>'; print_r($columns); echo '</pre>';
    // Connection::getColumnsData($table, $columns);
    //echo '<pre>'; print_r(Connection::getColumnsData($table, $columns)); echo '</pre>';

    /*Validar tablas y columnas*/

    if (empty(Connection::getColumnsData($table, $columns))) {

        $json = array(
            'status' => 404,
            'results' => "Error no se encuentran las tablas en la base de datos"
        );
        echo json_encode($json, http_response_code($json["status"]));
        // return;
    }

    $response = new PostController();
    /*Peticion POST para registrar usuarios*/

    if (isset($_GET["register"]) && $_GET["register"] == true) {

        $suffix = $_GET["suffix"] ?? "usuario";
        $response->postRegister($table, $_POST, $suffix);

        /*Peticion POST para LOGIN usuarios*/
    } else if (isset($_GET["login"]) && $_GET["login"] == true) {

        $suffix = $_GET["suffix"] ?? "usuario";
        $response->postLogin($table, $_POST, $suffix);
    } else {
        /*Se solicita respuesta al controlador para crear datos en cualquier tabla*/

        $response->postData($table, $_POST);
    }
}
