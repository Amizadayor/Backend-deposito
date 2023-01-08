<?php
require_once "../connection/connection.php";

class proveedores extends connection {

    private $table = "proveedor";
    private $Id = "Id";
    private $Nombre_1 = "Nombre_1";
    private $Nombre_2 = "Nombre_2";
    private $Apellido_paterno = "Apellido_paterno";
    private $Apellido_materno = "Apellido_materno";
    private $Numero_telefono = "Numero_telefono";
    private $Empresa = "Empresa"; 
    
    public function listarProveedores(){  
        $query = "SELECT * FROM " . $this->table;
        $datos = parent::obtenerDatos($query); 
        return ($datos);
    }

    public function obtenerId($id){
        $query = "SELECT * FROM " . $this->table . " WHERE Id = '$id'";
        return parent::obtenerDatos($query);

    }
    public function post($ingresar){
        $datos = json_decode($ingresar,true);
                if(!isset($datos['Nombre_1']) || !isset($datos['Nombre_2']) || !isset($datos['Apellido_paterno']) || !isset($datos['Apellido_materno']) || !isset($datos['Numero_telefono']) || !isset($datos['Empresa'])  ){
                }else{
                    $this->Nombre_1 = $datos['Nombre_1'];
                    $this->Nombre_2 = $datos['Nombre_2'];
                    $this->Apellido_paterno = $datos['Apellido_paterno'];
                    $this->Apellido_materno = $datos['Apellido_materno'];
                    $this->Numero_telefono = $datos['Numero_telefono'];
                    $this->Empresa = $datos['Empresa'];
                    
                    $resp = $this->insertProveedor();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $resp
                        );
                        return $respuesta;
                    }else{
                    }
                }
            }

    private function insertProveedor(){
        $query = "INSERT INTO " . $this->table . " (Nombre_1,Nombre_2,Apellido_paterno,Apellido_materno,Numero_telefono,Empresa)
        values
        ('" . $this->Nombre_1 . "','" . $this->Nombre_2 . "','" . $this->Apellido_paterno ."','" . $this->Apellido_materno . "','"  . $this->Numero_telefono . "','" . $this->Empresa . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }    



    public function put($edit){
        $datos = json_decode($edit,true);
                if(!isset($datos['Id'])){
                }else{
                    $this->Id = $datos['Id'];
                    if(isset($datos['Nombre_1'])) { $this->Nombre_1 = $datos['Nombre_1']; }
                    if(isset($datos['Nombre_2'])) { $this->Nombre_2 = $datos['Nombre_2']; }
                    if(isset($datos['Apellido_paterno'])) { $this->Apellido_paterno = $datos['Apellido_paterno']; }
                    if(isset($datos['Apellido_materno'])) { $this->Apellido_materno = $datos['Apellido_materno']; }
                    if(isset($datos['Numero_telefono'])) { $this->Numero_telefono = $datos['Numero_telefono']; }
                    if(isset($datos['Empresa'])) { $this->Empresa = $datos['Empresa']; }
                   
                    
                    $resp = $this->modificarProveedores();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }

            }




    private function modificarProveedores(){
        $query = "UPDATE " . $this->table . " SET Nombre_1 ='" . $this->Nombre_1 . "',Nombre_2 = '" . $this->Nombre_2 . "', Apellido_paterno = '" . 
        $this->Apellido_paterno . "', Apellido_materno = '" . $this->Apellido_materno . "', Numero_telefono = '" . $this->Numero_telefono . "', Empresa = '" . 
        $this->Empresa . "' WHERE Id = '" . $this->Id . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }




    public function delete($delete){
        $datos = json_decode($delete,true);
                if(!isset($datos['Id'])){
                }else{
                    $this->Id = $datos['Id'];
                    $resp = $this->eliminarProveedor();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }
    }



    private function eliminarProveedor(){
        $query = "DELETE FROM " . $this->table . " WHERE Id= '" . $this->Id . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
}





?>