<?php
require_once "connection.php";
require_once "get.model.php";

class DeleteModel
{

   /*Peticion delete para eliminar datos forma dinamica*/

   static public function deleteData($table, $id, $nameId)
   {
      //  echo '<pre>'; print_r($table); echo '</pre>';
      // echo '<pre>'; print_r($id); echo '</pre>';
      //echo '<pre>'; print_r($nameId); echo '</pre>';

      $response = GetModel::getDataFilter($table, $nameId, $nameId, $id, null, null, null, null);
      if (empty($response)) {
         return null;
      }
      /*Eliminamos registros*/
      $sql = "DELETE FROM $table WHERE $nameId = :$nameId";
      $link = Connection::connect();
      $stmt = $link->prepare($sql);

      $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_STR);
      if ($stmt -> execute()) {
         $response = array(
            "comment" => "Se ha eliminado correctamente"
         );
         return $response;
      }else{
         return $link -> errorInfo();
      }
      
   }
}
