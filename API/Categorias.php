<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,DELETE,PUT ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once '../Models/Categorias.php';

$catego = new categorias;


if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["listado"])){
        $listarcatego = $catego->listarCategorias();
        header("Content-Type: application/json");
        echo json_encode($listarcatego);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $idcatego = $_GET['id'];
        $datosCatego = $catego->obtenerId($idcatego);
        header("Content-Type: application/json");
        echo json_encode($datosCatego);
        http_response_code(200);
    }


}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET["agregar"])){
    $aporte = file_get_contents("php://input");
    $arreglo = $catego->post($aporte);
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
      $arreglo = $catego->put($aporte);
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
    
        $arreglo = $catego->delete($aporte);
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