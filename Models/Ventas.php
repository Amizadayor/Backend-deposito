<?php
require_once "../connection/connection.php";

class ventas extends connection {

    private $table = "venta";
    private $Id = "Id";
    private $Total_final = "Total_final";
    private $Cantidad_producto = "Cantidad_producto";
    private $Fecha_venta = "Fecha_venta";
    private $Cliente_id = "Cliente_id";
    private $Empleado_id = "Empleado_id";
     
    
    public function listarVentas(){  
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
                if(!isset($datos['Total_final']) || !isset($datos['Cantidad_producto_final']) || !isset($datos['Fecha_venta']) || !isset($datos['Cliente_id']) || !isset($datos['Empleado_id']) ){
                }else{
                    $this->Total_final = $datos['Total_final'];
                    $this->Cantidad_producto_final = $datos['Cantidad_producto_final'];
                    $this->Fecha_venta = $datos['Fecha_venta'];
                    $this->Cliente_id = $datos['Cliente_id'];
                    $this->Empleado_id = $datos['Empleado_id'];
                    
                    
                    $resp = $this->insertVentas();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $resp
                        );
                        return $respuesta;
                    }else{
                    }
                }
            }

    private function insertVentas(){
        $query = "INSERT INTO " . $this->table . " (Total_final,Cantidad_producto_final,Fecha_venta,Cliente_id,Empleado_id)
        values
        ('" . $this->Total_final . "','" . $this->Cantidad_producto_final . "','" . $this->Fecha_venta ."','" . $this->Cliente_id . "','"  . $this->Empleado_id . "')"; 
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
                    if(isset($datos['Total_final'])) { $this->Total_final = $datos['Total_final']; }
                    if(isset($datos['Cantidad_producto_final'])) { $this->Cantidad_producto_final = $datos['Cantidad_producto_final']; }
                    if(isset($datos['Fecha_venta'])) { $this->Fecha_venta = $datos['Fecha_venta']; }
                    if(isset($datos['Cliente_id'])) { $this->Cliente_id = $datos['Cliente_id']; }
                    if(isset($datos['Empleado_id'])) { $this->Empleado_id = $datos['Empleado_id']; }
                    
                   
                    
                    $resp = $this->modificarVentas();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }

            }




    private function modificarVentas(){
        $query = "UPDATE " . $this->table . " SET Total_final ='" . $this->Total_final . "',Cantidad_producto_final = '" . $this->Cantidad_producto_final . "', Fecha_venta = '" . 
        $this->Fecha_venta . "', Cliente_id = '" . $this->Cliente_id . "', Empleado_id = '" . $this->Empleado_id . "' WHERE Id = '" . $this->Id . "'"; 
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
                    $resp = $this->eliminarVentas();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }
    }



    private function eliminarVentas(){  
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