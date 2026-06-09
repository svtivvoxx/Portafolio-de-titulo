<?php
require_once 'conexion.php';
$clave_nueva = 'Infamus898'; 
$email_admin = 'admin@olivia.cl';
$hash_perfecto = password_hash($clave_nueva, PASSWORD_DEFAULT);
$query = "UPDATE usuarios SET password = '$hash_perfecto' WHERE email = '$email_admin'";

if (mysqli_query($conexion, $query)) {
    echo "<h3>¡Contraseña actualizada con éxito!</h3>";
    echo "Ahora puedes iniciar sesión con la clave: <b>" . $clave_nueva . "</b><br>";
    echo "Borra este archivo por seguridad antes de entregar tu proyecto.";
} else {
    echo "Error al actualizar: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>