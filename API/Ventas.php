<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,DELETE,PUT ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once '../Models/Ventas.php';

$ven = new ventas;
 

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["listado"])){
        $listarven = $ven->listarVentas();
        header("Content-Type: application/json");
        echo json_encode($listarven);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $idven = $_GET['id'];
        $datosVen = $ven->obtenerId($idven);
        header("Content-Type: application/json");
        echo json_encode($datosVen);
        http_response_code(200);
    }

    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET["agregar"])){
    $aporte = file_get_contents("php://input");
    $arreglo = $ven->post($aporte);
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
      $arreglo = $ven->put($aporte);
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
    
        $arreglo = $ven->delete($aporte);
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