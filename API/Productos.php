<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,DELETE,PUT ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once '../Models/Productos.php';

$produc = new productos;


if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["listado"])){
        $listarproduc = $produc->listarProductos();
        header("Content-Type: application/json");
        echo json_encode($listarproduc);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $idproduc = $_GET['id'];
        $datosProduc = $produc->obtenerId($idproduc);
        header("Content-Type: application/json");
        echo json_encode($datosProduc);
        http_response_code(200);
    }

    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET["agregar"])){
    $aporte = file_get_contents("php://input");
    $arreglo = $produc->post($aporte);
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
      $arreglo = $produc->put($aporte);
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
    
        $arreglo = $produc->delete($aporte);
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