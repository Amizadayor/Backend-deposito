<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,DELETE,PUT ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once '../Models/Productoventas.php';

$produven = new productoventas;
 

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["listado"])){
        $listarproduven = $produven->listarProductoventas();
        header("Content-Type: application/json");
        echo json_encode($listarproduven);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $idproduven = $_GET['id'];
        $datosProduven = $produven->obtenerId($idproduven);
        header("Content-Type: application/json");
        echo json_encode($datosProduven);
        http_response_code(200);
    }

    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET["agregar"])){
    $aporte = file_get_contents("php://input");
    $arreglo = $produven->post($aporte);
     header('Content-Type: application/json');
     if(isset($arreglo["result"]["error_id"])){
         $respuesta = $arreglo["result"]["error_id"];
         http_response_code($respuesta);
     }else{
         http_response_code(200);
     }
     echo json_encode($arreglo);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "PUT"){
    if(isset($_GET["editar"])){
      $aporte = file_get_contents("php://input");
      $arreglo = $produven->put($aporte);
     header('Content-Type: application/json');
     if(isset($arreglo["result"]["error_id"])){
         $respuesta = $arreglo["result"]["error_id"];
         http_response_code($respuesta);
     }else{
         http_response_code(200);
     }
     echo json_encode($arreglo);
    }

}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){
        $header = getallheaders();
        if(isset($header["Id"])){
            $send = [
                "Id" =>$header["Id"]
            ];
            $aporte = json_encode($send);
        }else{
            $aporte = file_get_contents("php://input");
        }
    
        $arreglo = $produven->delete($aporte);
        header('Content-Type: application/json');
        if(isset($arreglo["result"]["error_id"])){
            $respuesta = $arreglo["result"]["error_id"];
            http_response_code($respuesta);
        }else{
            http_response_code(200);
        }
        echo json_encode($arreglo);
       

}else{
    header('Content-Type: application/json');
    $arreglo = $respuesta->error_405();
    echo json_encode($arreglo);
}


?>