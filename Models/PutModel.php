<?php
require_once "connection.php";
class PutModel
{

    /*Peticion put para editar datos forma dinamica*/

   static public function putData($table, $data, $id, $nameId)
   {
      echo '<pre>'; print_r($table); echo '</pre>';
      echo '<pre>'; print_r($data); echo '</pre>';
      echo '<pre>'; print_r($id); echo '</pre>';
      echo '<pre>'; print_r($nameId); echo '</pre>';

     

   }
}