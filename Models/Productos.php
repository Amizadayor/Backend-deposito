<?php
require_once "../connection/connection.php";

class productos extends connection {

    private $table = "producto";
    private $Id = "Id";
    private $Nombre_producto = "Nombre_producto";
    private $Precio_producto = "Precio_producto";
    private $Stock = "Stock";
    private $Categoria_id = "Categoria_id";
    private $Proveedor_id = "Proveedor_id";
    
    
    public function listarProductos(){  
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
                if(!isset($datos['Nombre_producto']) || !isset($datos['Precio_producto']) || !isset($datos['Stock']) || !isset($datos['Categoria_id']) || !isset($datos['Proveedor_id']) ){
                }else{
                    $this->Nombre_producto = $datos['Nombre_producto'];
                    $this->Precio_producto = $datos['Precio_producto'];
                    $this->Stock = $datos['Stock'];
                    $this->Categoria_id = $datos['Categoria_id'];
                    $this->Proveedor_id = $datos['Proveedor_id'];
                    
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
        $query = "INSERT INTO " . $this->table . " (Nombre_producto,Precio_producto,Stock,Categoria_id,Proveedor_id)
        values
        ('" . $this->Nombre_producto . "','" . $this->Precio_producto . "','" . $this->Stock ."','" . $this->Categoria_id . "','"  . $this->Proveedor_id . "')"; 
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
                    if(isset($datos['Nombre_producto'])) { $this->Nombre_producto = $datos['Nombre_producto']; }
                    if(isset($datos['Precio_producto'])) { $this->Precio_producto = $datos['Precio_producto']; }
                    if(isset($datos['Stock'])) { $this->Stock = $datos['Stock']; }
                    if(isset($datos['Categoria_id'])) { $this->Categoria_id = $datos['Categoria_id']; }
                    if(isset($datos['Proveedor_id'])) { $this->Proveedor_id = $datos['Proveedor_id']; }
                                       
                    
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
        $query = "UPDATE " . $this->table . " SET Nombre_producto ='" . $this->Nombre_producto . "',Precio_producto = '" . $this->Precio_producto . "', Stock = '" . 
        $this->Stock . "', Categoria_id = '" . $this->Categoria_id . "', Proveedor_id = '" . $this->Proveedor_id . "' WHERE Id = '" . $this->Id . "'"; 
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