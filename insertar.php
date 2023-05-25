<?php
include_once 'config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelo = $_POST['modelo'];
    $valor = $_POST['valor'];
    $marca = $_POST['marca'];

    // Guardar la ruta de la imagen en la base de datos
    $rutaImagen = '';

    // Verificar si se subio la imagen
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = $_FILES['foto']['name'];
        $tipoImagen = $_FILES['foto']['type'];
        $tamanioImagen = $_FILES['foto']['size'];
        $rutaTemporal = $_FILES['foto']['tmp_name'];
        $rutaImagen = 'imagenes/' . $nombreImagen;

        // Mover la imagen a la ruta
        move_uploaded_file($rutaTemporal, $rutaImagen);
    }

    $sentencia = $bd->prepare("INSERT INTO vehiculos (modelo, valor, marca, foto) VALUES (?, ?, ?, ?)");
    $sentencia->execute([$modelo, $valor, $marca, $rutaImagen]);
  
    if ($sentencia === TRUE) {
        header('Location: index.php?mensaje=error');
    }else {
        header('Location: index.php?mensaje=registrado');
        exit();
    } 

}
?>
