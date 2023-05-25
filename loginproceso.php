<?php

session_start();
include_once 'config/conexion.php';
$usuario = $_POST['nombre'];
$contrasena = $_POST['contrasena'];


$sentencia = $bd->prepare('SELECT * FROM usuario WHERE nombre = ? AND contrasena = ?;');

$sentencia->execute([$usuario, $contrasena]);

$datos = $sentencia->fetch(PDO::FETCH_OBJ);


if ($datos === FALSE) {
    header('Location:login.php?mensaje=error');

} elseif ($sentencia->rowCount() == 1) {
    $_SESSION['nombre'] = $datos->nombre;
    header('Location:index.php');

}
?>