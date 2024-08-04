<?php
require_once "Models/DeleteModel.php";
class DeleteController
{
    /*Peticion delete para editar datos*/

    static public function deleteData($table, $id, $nameId)
    {

        $response = DeleteModel::deleteData($table, $id, $nameId);
        echo '<pre>'; print_r($response); echo '</pre>';
        return;


        $return = new DeleteController();
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
                    'method' => 'DELETE'
                );
            }
    
            echo json_encode($json, http_response_code($json["status"]));
        }
}
