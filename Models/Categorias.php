<?php
require_once "../connection/connection.php";

class categorias extends connection {

    private $table = "categoria";
    private $Id = "Id";
    private $Nombre_categoria = "Nombre_categoria";
    private $Capacidad_producto = "Capacidad_producto";
    
    
    public function listarCategorias(){  
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
                if(!isset($datos['Nombre_categoria']) || !isset($datos['Capacidad_producto']) ){
                }else{
                    $this->Nombre_categoria = $datos['Nombre_categoria'];
                    $this->Capacidad_producto = $datos['Capacidad_producto'];
                                        
                    $resp = $this->insertCategoria();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $resp
                        );
                        return $respuesta;
                    }else{
                    }
                }
            }

    private function insertCategoria(){
        $query = "INSERT INTO " . $this->table . " (Nombre_categoria,Capacidad_producto)
        values
        ('" . $this->Nombre_categoria . "','" . $this->Capacidad_producto . "')"; 
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
                    if(isset($datos['Nombre_categoria'])) { $this->Nombre_categoria = $datos['Nombre_categoria']; }
                    if(isset($datos['Capacidad_producto'])) { $this->Capacidad_producto = $datos['Capacidad_producto']; }
                                        
                    
                    $resp = $this->modificarCategorias();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }

            }




    private function modificarCategorias(){
        $query = "UPDATE " . $this->table . " SET Nombre_categoria ='" . $this->Nombre_categoria . "',Capacidad_producto = '" . $this->Capacidad_producto . "' WHERE Id = '" . $this->Id . "'"; 
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
                    $resp = $this->eliminarCategoria();
                    if($resp){
                        $respuesta[] = array(
                            "Id" => $this->Id
                        );
                        return $respuesta;
                    }else{
                    }
                }
    }



    private function eliminarCategoria(){
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