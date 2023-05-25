<?php
include_once 'config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener la ruta de la imagen antes de eliminar el registro
    $query = $bd->prepare("SELECT foto FROM vehiculos WHERE id = ?");
    $query->execute([$id]);
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($resultado) {
        $rutaImagen = $resultado['foto'];
        
        $query = $bd->prepare("DELETE FROM vehiculos WHERE id = ?");
        $query->execute([$id]);

        if ($query->rowCount() > 0) {
            // Eliminar la imagen del pc
            if (!empty($rutaImagen) && file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
            header('Location: index.php?mensaje=eliminado');
            exit();
        } else {
            header('Location: index.php?mensaje=error');
            exit();
        }
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
}
?>
