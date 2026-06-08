<?php
session_start();

// Destruir todas las variables de la sesión activa
session_unset();

// Destruir la sesión en el servidor
session_destroy();

// Redirigir de forma automática al formulario de inicio de sesión
header("Location: login.html");
exit();
?>