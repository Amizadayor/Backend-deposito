<?php
require_once "../connection/connection.php";

class empleados extends connection {

    private $table = "empleado";
    private $Id = "Id";
    private $Usuario = "Usuario";
    private $Password_empleado = "Password_empleado";
    private $Nombre_1 = "Nombre_1";
    private $Nombre_2 = "Nombre_2";
    private $Apellido_paterno = "Apellido_paterno";
    private $Apellido_materno = "Apellido_materno"; 
    private $Numero_telefono = "Numero_telefono"; 
    private $Direccion = "Direccion"; 
    private $Curp = "Curp"; 
    private $RFC = "RFC"; 
    
    public function listarEmpleados(){  
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
                if(!isset($datos['Usuario']) || !isset($datos['Password_empleado']) || !isset($datos['Nombre_1']) || !isset($datos['Nombre_2']) || !isset($datos['Apellido_paterno']) || !isset($datos['Apellido_materno']) || !isset($datos['Numero_telefono']) || !isset($datos['Direccion']) || !isset($datos['Curp']) || !isset($datos['RFC']) ){
                }else{
                    $this->Usuario = $datos['Usuario'];
                    $this->Password_empleado = $datos['Password_empleado'];
                    $this->Nombre_1 = $datos['Nombre_1'];
                    $this->Nombre_2 = $datos['Nombre_2'];
                    $this->Apellido_paterno = $datos['Apellido_paterno'];
                    $this->Apellido_materno = $datos['Apellido_materno'];
                    $this->Numero_telefono = $datos['Numero_telefono'];
                    $this->Direccion = $datos['Direccion'];
                    $this->Curp = $datos['Curp'];
                    $this->RFC = $datos['RFC'];
                    
                    $resp = $this->insertProducto();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $resp
                        );
                        return $respuesta;
                    }else{
                    }
                }
            }

    private function insertProducto(){
        $query = "INSERT INTO " . $this->table . " (Usuario,Password_empleado,Nombre_1,Nombre_2,Apellido_paterno,Apellido_materno,Numero_telefono,Direccion,Curp,RFC)
        values
        ('" . $this->Usuario . "','" . $this->Password_empleado . "','" . $this->Nombre_1 ."','" . $this->Nombre_2 . "','"  . $this->Apellido_paterno . "','" . $this->Apellido_materno . "','" . $this->Numero_telefono ."','" . $this->Direccion ."','" . $this->Curp ."','" . $this->RFC ."')"; 
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
                    if(isset($datos['Usuario'])) { $this->Usuario = $datos['Usuario']; }
                    if(isset($datos['Password_empleado'])) { $this->Password_empleado = $datos['Password_empleado']; }
                    if(isset($datos['Nombre_1'])) { $this->Nombre_1 = $datos['Nombre_1']; }
                    if(isset($datos['Nombre_2'])) { $this->Nombre_2 = $datos['Nombre_2']; }
                    if(isset($datos['Apellido_paterno'])) { $this->Apellido_paterno = $datos['Apellido_paterno']; }
                    if(isset($datos['Apellido_materno'])) { $this->Apellido_materno = $datos['Apellido_materno']; }
                    if(isset($datos['Numero_telefono'])) { $this->Numero_telefono = $datos['Numero_telefono']; } 
                    if(isset($datos['Direccion'])) { $this->Direccion = $datos['Direccion']; }
                    if(isset($datos['Curp'])) { $this->Curp = $datos['Curp']; }
                    if(isset($datos['RFC'])) { $this->RFC = $datos['RFC']; }

                    $resp = $this->modificarProductos();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }

            }




    private function modificarProductos(){
        $query = "UPDATE " . $this->table . " SET Usuario ='" . $this->Usuario . "',Password_empleado = '" . $this->Password_empleado . "', Nombre_1 = '" . 
        $this->Nombre_1 . "', Nombre_2 = '" . $this->Nombre_2 . "', Apellido_paterno = '" . $this->Apellido_paterno . "', Apellido_materno = '" . 
        $this->Apellido_materno . "', Numero_telefono = '" . $this->Numero_telefono . "', Direccion = '" . $this->Direccion . "', Curp = '" . 
        $this->Curp . "', RFC = '" . $this->RFC . "'WHERE Id = '" . $this->Id . "'"; 
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
                    $resp = $this->eliminarProductos();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }
    }



    private function eliminarProductos(){
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