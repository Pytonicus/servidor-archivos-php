<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json");

    if($_GET['ruta']){
        $rutaBase = $_GET['ruta'];
    }else{ 
        $rutaBase = "../archivos";
    }
    
    // Ordenamos los archivos para que muestre primero las carpetas:
    $ficheros = scandir($rutaBase, 1);

    $resultados = [];

    foreach($ficheros as $clave => $valor){
        $infoArchivo = [];
        $infoArchivo['nombre'] = $valor;
        $infoArchivo['tipo'] = filetype($rutaBase . '/' . $valor);
        $infoArchivo['extension'] = obtenerExtension($rutaBase . '/' . $valor);
        $infoArchivo['tamano'] = convertirBytes(filesize($rutaBase . '/' . $valor));

        $infoArchivo['ruta'] = $rutaBase;

        $infoArchivo['raiz'] = dirname($rutaBase, 1);

        if($valor!='.' && $valor!='..'){
            array_push($resultados, $infoArchivo);
        }
    }

    function obtenerExtension($nombreDeArchivo){
        $tipo = fileType($nombreDeArchivo);
        if($tipo == 'file'){
            return substr($nombreDeArchivo , strripos($nombreDeArchivo, '.') + 1); // Con + 1 no mostrará el . de la extensión
        }else{
            return $tipo; 
        }
    }

    function convertirBytes($bytes){
        $decimales = 0;
        $unidades = ['B', 'KB', 'MB', 'GB'];
        $exp = floor(log($bytes, 1024)) | 0;

        return round($bytes / (pow(1024, $exp)), $decimales) . $unidades[$exp];
    }
    print_r(stripslashes(json_encode($resultados) ));
?>