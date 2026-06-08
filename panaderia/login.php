<?php ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso | Olivia's Panadería</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Arimo&display=swap" rel="stylesheet">
    <style>
        .auth-container { max-width: 400px; margin: 80px auto; padding: 30px; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); font-family: 'Arimo', sans-serif; }
        .auth-form h2 { font-family: 'Merriweather', serif; color: #5d3a1a; margin-bottom: 20px; text-align: center; }
        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 5px; color: #555; }
        .input-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .auth-btn { width: 100%; background-color: #5d3a1a; color: white; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem; }
        .auth-btn:hover { background-color: #4a2d14; }
        .switch-form { text-align: center; margin-top: 15px; font-size: 0.9rem; }
        .switch-form a { color: #c05746; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body style="background-color: #fffaf1;">

    <div class="auth-container">
        <div id="login-section" class="auth-form">
            <h2>Iniciar Sesión</h2>
            <form action="procesar_auth.php" method="POST">
                <input type="hidden" name="accion" value="login">
                <div class="input-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" required>
                </div>
                <div class="input-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="auth-btn">Entrar</button>
            </form>
            <div class="switch-form">
                ¿No tienes cuenta? <a href="#" onclick="toggleForm(true)">Regístrate aquí</a>
            </div>
        </div>

        <div id="register-section" class="auth-form" style="display: none;">
            <h2>Crear Cuenta</h2>
            <form action="procesar_auth.php" method="POST">
                <input type="hidden" name="accion" value="registro">
                <div class="input-group">
                    <label>Nombre Completo</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="input-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" required>
                </div>
                <div class="input-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="auth-btn" style="background-color: #c05746;">Registrarse</button>
            </form>
            <div class="switch-form">
                ¿Ya tienes cuenta? <a href="#" onclick="toggleForm(false)">Inicia sesión</a>
            </div>
        </div>
    </div>

    <script>
        function toggleForm(showRegister) {
            
            document.getElementById('login-section').style.display = showRegister ? 'none' : 'block';
            document.getElementById('register-section').style.display = showRegister ? 'block' : 'none';
        }
    </script>
</body>
</html>