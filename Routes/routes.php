<?php
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);


/*Sucede esto cuando no se le hace petición a la API */

if (count($routesArray) == 0) {
    $json = array(
        'status' => 404,
        'result' => 'Not Found'

    );
    echo json_encode($json, http_response_code($json["status"]));
    return;
}

/*Cuando se hace una petición a al API */

if (count($routesArray) == 1 && isset($_SERVER['REQUEST_METHOD'])) {
    $table = explode("?", $routesArray[1])[0];
    /*PETICION GET*/
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        include "services/get.php";
    }

    /*PETICION POST*/
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        include "services/post.php";
    }
    /*PETICION PUT*/
    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
        include "services/put.php";
    }
    /*PETICION DELETE*/
    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        include "services/delete.php";
    }
}
