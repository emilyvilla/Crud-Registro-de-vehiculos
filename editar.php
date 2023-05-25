<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id'])) {
        header('Location: index.php?mensaje=error');
        exit();
    }

    include 'config/conexion.php';

    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $valor = $_POST['valor'];
    $marca = $_POST['marca'];

    // Verificar si se selecciono una nueva foto
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = $_FILES['foto']['name'];
        $tipoImagen = $_FILES['foto']['type'];
        $tamanioImagen = $_FILES['foto']['size'];
        $rutaTemporal = $_FILES['foto']['tmp_name'];
        $rutaImagenNueva = 'imagenes/' . $nombreImagen;

        // Eliminar la imagen anterior
        $sentenciaImagenAnterior = $bd->prepare("SELECT foto FROM vehiculos WHERE id = ?");
        $sentenciaImagenAnterior->execute([$id]);
        $rutaImagenAnterior = $sentenciaImagenAnterior->fetchColumn();

        if (!empty($rutaImagenAnterior) && file_exists($rutaImagenAnterior)) {
            unlink($rutaImagenAnterior);
        }

        // subir foto al pc
        move_uploaded_file($rutaTemporal, $rutaImagenNueva);
        $rutaImagen = $rutaImagenNueva;
    } else {
        $sentenciaImagen = $bd->prepare("SELECT foto FROM vehiculos WHERE id = ?");
        $sentenciaImagen->execute([$id]);
        $rutaImagen = $sentenciaImagen->fetchColumn();
    }

    $sentencia = $bd->prepare("UPDATE vehiculos SET modelo = ?, valor = ?, marca = ?, foto = ? WHERE id = ?");
    $resultado = $sentencia->execute([$modelo, $valor, $marca, $rutaImagen, $id]);

    if ($resultado === true) {
        header('Location: index.php?mensaje=editado');
        exit();
    } else {
        header('Location: editar.php?mensaje=error');
        exit();
    }
}
?>
