<?php
require_once "../connection/connection.php";

class productoventas extends connection {

    private $table = "productoventa";
    private $Id = "Id";
    private $Total_venta = "Total_venta";
    private $Cantidad_producto_vendido = "Cantidad_producto_vendido";
    private $Producto_id = "Producto_id";
    private $Venta_id = "Venta_id";
    
    
    public function listarProductoventas(){  
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
                if(!isset($datos['Total_venta']) || !isset($datos['Cantidad_producto_vendido']) || !isset($datos['Producto_id']) || !isset($datos['Venta_id'])  ){
                }else{
                    $this->Total_venta = $datos['Total_venta'];
                    $this->Cantidad_producto_vendido = $datos['Cantidad_producto_vendido'];
                    $this->Producto_id = $datos['Producto_id'];
                    $this->Venta_id = $datos['Venta_id'];
                    
                    
                    $resp = $this->insertProductoventas();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $resp
                        );
                        return $respuesta;
                    }else{
                    }
                }
            }

    private function insertProductoventas(){
        $query = "INSERT INTO " . $this->table . " (Total_venta,Cantidad_producto_vendido,Producto_id,Venta_id)
        values
        ('" . $this->Total_venta . "','" . $this->Cantidad_producto_vendido . "','" . $this->Producto_id ."','" . $this->Venta_id . "')"; 
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
                    if(isset($datos['Total_venta'])) { $this->Total_venta = $datos['Total_venta']; }
                    if(isset($datos['Cantidad_producto_vendido'])) { $this->Cantidad_producto_vendido = $datos['Cantidad_producto_vendido']; }
                    if(isset($datos['Producto_id'])) { $this->Producto_id = $datos['Producto_id']; }
                    if(isset($datos['Venta_id'])) { $this->Venta_id = $datos['Venta_id']; }
                    
                   
                    
                    $resp = $this->modificarProductoventas();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }

            }




    private function modificarProductoventas(){
        $query = "UPDATE " . $this->table . " SET Total_venta ='" . $this->Total_venta . "',Cantidad_producto_vendido = '" . $this->Cantidad_producto_vendido . "', Producto_id = '" . 
        $this->Producto_id . "', Venta_id = '" . $this->Venta_id . "' WHERE Id = '" . $this->Id . "'"; 
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
                    $resp = $this->eliminarProductoventas();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }
    }



    private function eliminarProductoventas(){
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