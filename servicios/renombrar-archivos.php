<?php
// Añadimos las cabeceras para CORS:
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

// Vamos a ejecutar el código solo si recibe una petición GET:
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    // Verificamos que solo funcione si recibe algo en las variables get:
    if($_GET['ruta-archivo'] && $_GET['nuevo-archivo']){
        // Utilizamos la función rename para renombrar el archivo y le pasamos dos variables via GET:
        $renombrar = rename($_GET['ruta-archivo'], $_GET['nuevo-archivo']);

        // Verificamos que la operación se ha realizado correctamente o no:
        if($renombrar){
            echo json_encode(array(
                'status' => 'Ok'
            ));
        }else{
            echo json_encode(array(
                'status' => 'error',
                'error' => 'No se ha podido renombrar el archivo'
            ));
        }
    }

}else{
    header('HTTP/1.1 405 Method Not Allowed');
    exit;
}

?>