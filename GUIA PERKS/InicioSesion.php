<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('conexion.php');

function validate($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if (isset($_POST['Usuario']) && isset($_POST['Clave'])) {
    $Usuario = validate($_POST['Usuario']);
    $Clave = validate($_POST['Clave']);

    if (empty($Usuario)) {
        header("Location: LOGIN.php?error=El usuario es requerido");
        exit();
    } elseif (empty($Clave)) {
        header("Location: LOGIN.php?error=La contraseña es requerida");
        exit();
    } else {
        // Puedes usar hash más seguro si es necesario
        $Clave = md5($Clave);

        $Sql = "SELECT * FROM usuarios WHERE Usuario = ? AND Clave = ?";
        $stmt = mysqli_prepare($conexion, $Sql);
        mysqli_stmt_bind_param($stmt, "ss", $Usuario, $Clave);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['Usuario'] === $Usuario && $row['Clave'] === $Clave) {
                $_SESSION['Usuario'] = $row['Usuario'];
                $_SESSION['Nombre_Completo'] = $row['Nombre_Completo'];
                $_SESSION['Id'] = $row['Id'];
                header("Location: inicio.html"); // Actualiza la ruta
                exit();
            } else {
                header("Location: LOGIN.php?error=El usuario o la contraseña son incorrectos");
                exit();
            }
        } else {
            header("Location: LOGIN.php?error=El usuario o la contraseña son incorrectos");
            exit();
        }
    }
} else {
    header("Location: LOGIN.php");
    exit();
}
?>
