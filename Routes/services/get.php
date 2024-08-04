<?php
require_once "Controllers/get_controller.php";

$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;
$startAt = $_GET["startAt"] ?? null;
$endAt = $_GET["endAt"] ?? null;
$response = new GetController();

/*Peticiones con Filtro */

if (isset($_GET["linkTo"]) && isset($_GET["equalTo"])) {
    $response->getDataFilter($table, $select, $_GET["linkTo"], $_GET["equalTo"],$orderBy,$orderMode,$startAt,$endAt);

    /*Peticiones GET para el buscador sin Filtro */
}else if(isset($_GET["linkTo"]) && isset($_GET["search"])){
    $response->getDataSearch($table, $select, $_GET["linkTo"], $_GET["search"],$orderBy,$orderMode,$startAt,$endAt);
}else {
    /*Peticiones sin Filtro */
    $response->getData($table, $select,$orderBy,$orderMode,$startAt,$endAt);
}
