<?php

class connection
{

    private $server =  "localhost";
    private $user = "root";
    private $password = "";
    private $database = "deposito";

    private $connection;


    function __construct()
    {
        $this->connection = new mysqli($this->server, $this->user, $this->password, $this->database);
        if ($this->connection->connect_errno) {
            echo "Error al establecer la conexion";
        }
    }

    public function obtenerDatos($sqlstr)
    {
        $results = $this->connection->query($sqlstr);
        $resultArray = array();
        foreach ($results as $key) {
            $resultArray[] = $key;
        }
        return $this->convertirUTF8($resultArray);
    }

    private function convertirUTF8($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    public function nonQuery($sqlstr)
    {
        $this->connection->query($sqlstr);
        return $this->connection->affected_rows;
    }

    public function nonQueryId($sqlstr)
    {
        $this->connection->query($sqlstr);
        $filas = $this->connection->affected_rows;
        if ($filas >= 1) {
            return $this->connection->insert_id;
        } else {
            return 0;
        }
    }
}
