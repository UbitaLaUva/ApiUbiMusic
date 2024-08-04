<?php
require_once "Models/get.model.php";

class GetController
{
    /*Peticiones con Filtro */
    static public function getDataFilter($table, $select, $linkTo, $equalTo,$orderBy,$orderMode,$startAt,$endAt)
    {
        $response = GetModel::getDataFilter($table, $select, $linkTo, $equalTo,$orderBy,$orderMode,$startAt,$endAt);
        $return = new GetController();
        $return->fncResponse($response);
        return $response;
    }

    /*Peticiones sin Filtro */
    static public function getData($table, $select,$orderBy,$orderMode,$startAt,$endAt)
    {
        $response = GetModel::getData($table, $select,$orderBy,$orderMode,$startAt,$endAt);
        $return = new GetController();
        $return->fncResponse($response);
        return $response;
    }

    

    /*Peticiones GET sin Filtro entre tablas relacionadas
    static public function getRelData($rel,$type,$select,$orderBy,$orderMode,$startAt,$endAt)
    {
        $response = GetModel::getRelData($rel,$type,$select,$orderBy,$orderMode,$startAt,$endAt);
        $return = new GetController();
        $return->fncResponse($response);
        return $response;
    }
*/

    /*Peticiones GET para el buscador sin Filtro */

    static public function getDataSearch($table, $select, $linkTo, $search,$orderBy,$orderMode,$startAt,$endAt)
    {
        $response = GetModel::getDataSearch($table, $select, $linkTo, $search,$orderBy,$orderMode,$startAt,$endAt);
        $return = new GetController();
        $return->fncResponse($response);
        
    }

    /*respuestas controllador*/

    public function fncResponse($response)
    {
        if (!empty($response)) {
            $json = array(
                'status' => 200,
                'total' => count($response),
                'results' => $response

            );
        } else {
            $json = array(
                'status' => 404,
                'results' => 'NOT FOUND'
            );
        }

        echo json_encode($json, http_response_code($json["status"]));
    }
}
