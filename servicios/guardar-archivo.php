<?php
    // Establecemos las cabeceras con algunas diferencias a los otros archivos del servidor:
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers", "X-Requested-With,content-type");

    // Vamos a incluir un parámetro ruta que recibiremos via POST:
    if($_POST['ruta']){
        $rutaBase = $_POST['ruta'];
    }else{
        $rutaBase = '../archivos';
    }

    // Comprobamos si existe el parámetro tipo files llamado file para la carga de archivos desde html:
    if(isset($_FILES['file'])){
        // Cargamos la ruta del archivo con el nombre del mismo:
        $archivoRuta = $rutaBase . '/' . $_FILES['file']['name'];

        // Ahora vamos a comprobar que la carga del archivo es correcta mientras este mismo se realiza en la condición y devolvemos una respuesta:
        if(move_uploaded_file($_FILE['file']['tmp_name'], $archivoRuta)){
            echo json_encode(array(
                'status' => 'ok'
            ));
        }
    }

?>