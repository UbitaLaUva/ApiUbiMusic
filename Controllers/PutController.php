<?php
require_once "Models/PutModel.php";
class PutController
{
    /*Peticion put para editar datos*/

    static public function putData($table, $data, $id, $nameId)
    {

        $response = PutModel::putData($table, $data, $id, $nameId);
        echo '<pre>'; print_r($response); echo '</pre>';
        return;


        $return = new PutController();
        $return->fncResponse($response);
 
    }

        /*respuestas controllador*/

        public function fncResponse($response)
        {
            if (!empty($response)) {
                $json = array(
                    'status' => 200,
                    'results' => $response
    
                );
            } else {
                $json = array(
                    'status' => 404,
                    'results' => 'NOT FOUND',
                    'method' => 'PUT'
                );
            }
    
            echo json_encode($json, http_response_code($json["status"]));
        }
}
