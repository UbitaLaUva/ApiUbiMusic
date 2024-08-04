<?php

class Connection{
    /*Informacion de la base de datos*/

    static public function infoDatabase(){

        $infoDB = array(
            "database" => "ubimusic",
            "user" => "root",
            "pass" => "root"
        );


        return $infoDB;
    }

    /* Conexion a la base de datos*/

    static public function connect(){
        try {
            $link = new PDO(
                "mysql: host=localhost;dbname=".Connection::infoDatabase()["database"],
                Connection::infoDatabase()["user"],
                Connection::infoDatabase()["pass"]
            );
            $link->exec("set names utf8");
        } catch (\Throwable $th) {
            die("Error: ".$th->getMessage());
        }
        return $link;
    }

    /* validar existencia de una tabla en la bd*/

    static public function getColumnsData($table, $columns){
        /* nombre de la base de datos*/
        $database = Connection::infoDatabase()["database"];
        /* traer todas las columnas*/
        $validate = Connection::connect()
        ->query("SELECT COLUMN_NAME AS item FROM information_schema.columns WHERE table_schema = '$database' AND table_name = '$table'")
        ->fetchAll(PDO::FETCH_OBJ);

        /* Se valida que la tabla exista*/

        if (empty($validate)) {
            return null;
        }else{
            /* Solicitud a columnas globales*/
            if ($columns[0] == "*") {
                array_shift($columns);
            }
            /* validar existencia de columna*/

            $sum = 0;
            foreach ($validate as $key => $value) {
                $sum += in_array($value->item, $columns);
            }

            return $sum == count($columns) ? $validate : null;
        }
    }

}