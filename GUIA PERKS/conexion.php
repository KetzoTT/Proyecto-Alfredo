<?php
$host = "localhost";
$User = "root";
$pass = "";
$db = "iniciosesiondb";

// Crear conexión
$conexion = mysqli_connect($host, $User, $pass, $db);

// Verificar conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
