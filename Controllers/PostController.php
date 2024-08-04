<?php
require_once "Models/get.model.php";
require_once "Models/PostModel.php";
class PostController
{
    /*Peticion post para crear datos*/

    static public function postData($table, $data)
    {

        $response = PostModel::postData($table, $data);

        $return = new PostController();
        $return->fncResponse($response, null);
    }



    /*Peticion post para crear usuarios*/

    static public function postRegister($table, $data, $suffix)
    {
        if (isset($data["password_" . $suffix]) && $data["password_" . $suffix] != null) {
            $crypt = crypt($data["password_" . $suffix], '$2a$07$usesomesillystringforsalt$');
            $data["password_" . $suffix] = $crypt;
            // echo '<pre>'; print_r($data["password_".$suffix]); echo '</pre>';
            // return;
            $response = PostModel::postData($table, $data);
            $return = new PostController();
            $return->fncResponse($response, null);
        }
    }


    /*Peticion post para login usuarios*/

    static public function postLogin($table, $data, $suffix)
    {
        /*Validar que el usuario exista en base de datos*/
        $response = GetModel::getDataFilter($table, "*", "email_" . $suffix, $data["email_" . $suffix], null, null, null, null);
        if (!empty($response)) {
            //encriptamos contraseña

            $crypt = crypt($data["password_" . $suffix], '$2a$07$usesomesillystringforsalt$');

            if ($response[0]->{"password_" . $suffix} == $crypt) {
                echo "Sesión iniciada con: " . $data["email_" . $suffix];
                
            } else {
                $response = null;
                $return = new PostController();
                $return->fncResponse($response, "Contraseña Incorrecta");
            }
            // return;
            //  return null;
        } else {
            $response = null;
            $return = new PostController();
            $return->fncResponse($response, "Correo Incorrecto");
        }
    }

    /*respuestas controllador*/

    public function fncResponse($response, $error)
    {
        if (!empty($response)) {
            $json = array(
                'status' => 200,
                'results' => $response

            );
        } else {
            if ($error != null) {
                $json = array(
                    'status' => 404,
                    'results' => $error
                );
            } else {
                $json = array(
                    'status' => 404,
                    'results' => 'NOT FOUND',
                    'method' => 'POST'
                );
            }
        }
        echo json_encode($json, http_response_code($json["status"]));
    }
}
