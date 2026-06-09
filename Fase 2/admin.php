<?php
session_start();
$_SESSION['usuario_rol'] = 'admin';
$_SESSION['usuario_nombre'] = 'Olivia Dueña';
require_once 'conexion.php';

if (!isset($_SESSION['usuario_rol']) || ($_SESSION['usuario_rol'] !== 'admin' && $_SESSION['usuario_rol'] !== 'interno')) {
    echo "<script>alert('Acceso denegado. Se requieren permisos de gestión.'); window.location.href='login.html';</script>";
    exit();
}

$rolActual = $_SESSION['usuario_rol'];
$nombreAdmin = $_SESSION['usuario_nombre'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    if (isset($_POST['crear_producto']) && $rolActual === 'admin') {
        $nombre = $_POST['nombre']; 
        $precio = $_POST['precio']; 
        $cat = $_POST['categoria'];
        
        $stmt = $conexion->prepare("INSERT INTO productos (nombre, precio, categoria) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $nombre, $precio, $cat);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Producto agregado con éxito.'); window.location.href='admin.php';</script>";
    }
    
    
    if (isset($_POST['eliminar_producto']) && $rolActual === 'admin') {
        $id = $_POST['id_producto'];
        
        $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Producto eliminado.'); window.location.href='admin.php';</script>";
    }
    
    if (isset($_POST['crear_noticia'])) {
        $titulo = $_POST['titulo']; 
        $contenido = $_POST['contenido'];
        
        $stmt = $conexion->prepare("INSERT INTO noticias (titulo, contenido) VALUES (?, ?)");
        $stmt->bind_param("ss", $titulo, $contenido);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Noticia publicada en el blog.'); window.location.href='admin.php';</script>";
    }
    
    if (isset($_POST['confirmar_pedido'])) {
        $id_pedido = $_POST['id_pedido'];
        $nuevo_estado = 'Aprobado'; 
        
        $stmt = $conexion->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $nuevo_estado, $id_pedido);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Pedido #" . $id_pedido . " CONFIRMADO con éxito.'); window.location.href='admin.php';</script>";
    }
    
    if (isset($_POST['rechazar_pedido'])) {
        $id_pedido = $_POST['id_pedido'];
        $nuevo_estado = 'Rechazado';
        
        $stmt = $conexion->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $nuevo_estado, $id_pedido);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Pedido #" . $id_pedido . " RECHAZADO.'); window.location.href='admin.php';</script>";
    }
}

$productos = $conexion->query("SELECT * FROM productos");
$noticias = $conexion->query("SELECT * FROM noticias");
$pedidos = $conexion->query("SELECT * FROM pedidos ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control Interno | Olivia's Panadería</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-box { padding: 40px 8%; font-family: Arial, sans-serif; background-color: #fffaf1; min-height: 100vh; }
        .seccion-admin { background: white; padding: 30px; margin-bottom: 35px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); }
        h2 { font-family: Arial, sans-serif; color: #5d3a1a; margin-bottom: 20px; }
        h3 { color: #5d3a1a; border-bottom: 2px solid #5d3a1a; padding-bottom: 5px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: white; }
        th, td { padding: 12px; border: 1px solid #eee; text-align: left; }
        th { background-color: #5d3a1a; color: white; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #666; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-panel { background-color: #5d3a1a; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .btn-panel:hover { background-color: #4a2d14; }
        .badge { padding: 4px 8px; border-radius: 4px; color: white; font-weight: bold; font-size: 0.85rem; }
        .Aprobado { background-color: #27ae60; }
        .Pendiente { background-color: #f39c12; }
        .Rechazado { background-color: #c05746; }
        .btn-action { padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; font-size: 0.85rem; font-weight: bold; }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="">Olivia's Backend ⚙️</div>
        <nav>
            <ul>
                <li><a href="index.php">Ir a la Web</a></li>
                <li><a href="cierresesion.php" style="color: #c05746; font-weight: bold;">Cerrar Sesión ✕</a></li>
            </ul>
        </nav>
    </header>
    <div class="admin-box">
        <h2>Bienvenido(a), <?php echo htmlspecialchars($nombreAdmin); ?> 👋</h2>
        <p style="margin-bottom: 30px;">Nivel de privilegios actual: <strong style="color: #c05746;"><?php echo strtoupper($rolActual); ?></strong></p>
        <div class="seccion-admin">
            <h3>Historial de Ventas e Integración Webpay</h3>
            <p>Monitoreo en tiempo real de transacciones electrónicas autorizadas por Transbank:</p>
            <?php if ($pedidos->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Orden de Compra</th>
                            <th>Monto Transacción</th>
                            <th>Estado de Transacción</th>
                            <th>Fecha/Hora</th>
                            <th>Acciones de Gestión</th> </tr>
                    </thead>
                    <tbody>
                        <?php while($p = $pedidos->fetch_assoc()): ?>
                        <tr>
                            <td><strong>#<?php echo $p['id']; ?></strong></td>
                            <td><?php echo $p['orden_compra']; ?></td>
                            <td>$<?php echo number_format($p['monto'], 0, ',', '.'); ?></td>
                            <td><span class="badge <?php echo $p['estado']; ?>"><?php echo $p['estado']; ?></span></td>
                            <td><?php echo $p['fecha']; ?></td>
                            <td>
                                <form method="POST" style="display:inline-block; margin-right: 5px;">
                                    <input type="hidden" name="id_pedido" value="<?php echo $p['id']; ?>">
                                    <button type="submit" name="confirmar_pedido" style="background-color: #27ae60; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; font-size: 0.85rem;">Confirmar</button>
                                </form>
                                <form method="POST" style="display:inline-block;">
                                    <input type="hidden" name="id_pedido" value="<?php echo $p['id']; ?>">
                                    <button type="submit" name="rechazar_pedido" style="background-color: #c05746; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; font-size: 0.85rem;" onclick="return confirm('¿Seguro que deseas rechazar este pedido?');">Rechazar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #777; font-style: italic; margin-top: 15px;">Aún no se registran intentos de pago en el sistema.</p>
            <?php endif; ?>
        </div>
        <div class="seccion-admin">
            <h3>Gestión de Catálogo (Líneas Saludables)</h3>
            
            <?php if ($rolActual === 'admin'): ?>
                <h4 style="color: #5d3a1a; margin-bottom: 10px;">Añadir Nuevo Producto comercial:</h4>
                <form method="POST" style="margin-bottom: 30px; background: #fafafa; padding: 20px; border-radius: 5px;">
                    <div class="form-group">
                        <label>Nombre del Producto</label>
                        <input type="text" name="nombre" placeholder="Ej: Pan de Molde Integral" required>
                    </div>
                    <div class="form-group">
                        <label>Precio de Venta ($)</label>
                        <input type="number" name="precio" placeholder="Ej: 3500" required>
                    </div>
                    <div class="form-group">
                        <label>Categoría Especial (Alergias)</label>
                        <select name="categoria">
                            <option value="Sin Gluten">Sin Gluten (Celiacos)</option>
                            <option value="Vegano">Vegano</option>
                            <option value="Integral">Integral (Diabéticos)</option>
                        </select>
                    </div>
                    <button type="submit" name="crear_producto" class="btn-panel">Guardar en Catálogo</button>
                </form>
            <?php else: ?>
                <p style="color: #c05746; font-style: italic; background: #fdf2f0; padding: 10px; border-radius: 5px;">
                    🔒 Tu nivel de acceso (Personal Interno) te permite visualizar los productos comerciales, pero no crear ni eliminar registros de la tienda.
                </p>
            <?php endif; ?>
            <table style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Producto</th>
                        <th>Precio</th>
                        <th>Categoría Especial</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($prod = $productos->fetch_assoc()): ?>
                    <tr>
                        <td>#<?php echo $prod['id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($prod['nombre']); ?></strong></td>
                        <td>$<?php echo number_format($prod['precio'], 0, ',', '.'); ?></td>
                        <td><?php echo $prod['categoria']; ?></td>
                        <td>
                            <?php if ($rolActual === 'admin'): ?>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas remover este producto?');">
                                    <input type="hidden" name="id_producto" value="<?php echo $prod['id']; ?>">
                                    <button type="submit" name="eliminar_producto" style="color:#c05746; background:none; border:none; cursor:pointer; font-weight:bold;">[Eliminar]</button>
                                </form>
                            <?php else: ?>
                                <span style="color:#aaa;">Bloqueado</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="seccion-admin">
            <h3>Módulo Informativo y Blog</h3>
            <p style="margin-bottom: 15px;">Publica novedades sobre nutrición y celiaquía indexadas simuladamente a Redes Sociales:</p>
            
            <form method="POST" style="background: #fafafa; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                <div class="form-group">
                    <label>Título Informativo</label>
                    <input type="text" name="titulo" placeholder="Ej: Beneficios de la masa madre sin gluten" required>
                </div>
                <div class="form-group">
                    <label>Contenido del Artículo</label>
                    <textarea name="contenido" rows="4" placeholder="Escribe aquí los párrafos informativos para tus clientes..." required></textarea>
                </div>
                <button type="submit" name="crear_noticia" class="btn-panel" style="background-color: #27ae60;">Publicar Artículo</button>
            </form>
            <h4>Artículos Publicados:</h4>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Fecha Creación</th>
                        <th>Difusión RRSS (Simulado)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($not = $noticias->fetch_assoc()): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($not['titulo']); ?></strong></td>
                        <td><?php echo $not['fecha']; ?></td>
                        <td>
                            <button onclick="alert('Indexando metatags automáticamente en Meta Graph API para Facebook...')" class="btn-panel" style="padding: 4px 8px; font-size: 0.8rem; background-color: #3b5998;">Facebook</button>
                            <button onclick="alert('Conectando con la API de Instagram Business para autopublicación...')" class="btn-panel" style="padding: 4px 8px; font-size: 0.8rem; background-color: #e1306c;">Instagram</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="function.js"></script>
</body>
</html>