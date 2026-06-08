<?php ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | Olivia's Panadería</title>
    <link rel="stylesheet" href="style.css"> <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Arimo&display=swap" rel="stylesheet">
</head>
<body>

    <header class="navbar">
        <?php include 'header.php'; ?>
    </header>

    <section style="padding: 50px; text-align: center;">
        <h1>Contáctanos</h1>
        <p>Estamos en Santiago, Chile. ¡Escríbenos para pedidos especiales!</p>
        
        <form style="display: flex; flex-direction: column; max-width: 400px; margin: 0 auto; gap: 10px;">
            <input type="text" placeholder="Nombre completo" style="padding: 10px;">
            <input type="email" placeholder="Correo electrónico" style="padding: 10px;">
            <textarea placeholder="Tu mensaje" style="padding: 10px; height: 100px;"></textarea>
            <button type="submit" class="btn">Enviar</button>
        </form>
    </section>
<script src="function.js"></script>
</body>
</html>