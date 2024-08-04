<?php

/*Mostrar ERRORES */

ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log", "C:/xampp/htdocs/php_error_log");

/*Requerimientos */

require_once "Models/connection.php";


/*echo '<pre>'; print_r(Connection::connect()); echo '</pre>';*/



require_once "Controllers/routes_controller.php";

$index = new RoutesController();
$index -> index();

error_reporting(E_ALL);
ini_set('display_errors', 1);

