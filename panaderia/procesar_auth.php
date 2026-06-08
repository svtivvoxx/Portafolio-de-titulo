<?php
session_start();
require_once 'conexion.php';
$accion = $_POST['accion'] ?? '';
if ($accion === 'registro') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $passwordHash);
    if ($stmt->execute()) {
        echo "<script>alert('¡Registro exitoso! Ya puedes iniciar sesión.'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('El correo ya está registrado.'); window.location.href='login.html';</script>";
    }
    $stmt->close();
}
if ($accion === 'login') { 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conexion->prepare("SELECT id, nombre, password, rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        
        
        if (password_verify($password, $usuario['password'])) {
            // Guardar los datos en la sesión activa de PHP
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_rol'] = $usuario['rol'];
            
            echo "<script>alert('¡Bienvenido(a) " . $usuario['nombre'] . "!'); window.location.href='perfil.php';</script>";
        } else {
            echo "<script>alert('Contraseña incorrecta.'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('El correo no está registrado.'); window.location.href='login.html';</script>";
    }
    $stmt->close();
}
$conexion->close();
?>