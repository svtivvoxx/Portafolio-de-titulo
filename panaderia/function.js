// funciones.js

// 1. Contador del carrito (para el menú)
function actualizarContadorCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const cantidadTotal = carrito.reduce((sum, item) => sum + item.cantidad, 0);
    const contador = document.getElementById('carrito-cantidad');
    if (contador) {
        contador.innerText = cantidadTotal;
    }
}

// 2. Cargar el carrito en carrito.html
function cargarCarrito() {
    const contenedor = document.getElementById('contenido-carrito');
    const footer = document.getElementById('footer-carrito');
    const montoTotal = document.getElementById('monto-total');
    
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    if (carrito.length === 0) {
        if(contenedor) {
            contenedor.innerHTML = `
                <div style="text-align: center; padding: 50px;">
                    <p style="font-size: 1.2rem;">Tu carrito está vacío.</p>
                    <a href="catalogo.php" class="btn">Ir al Catálogo</a>
                </div>`;
            footer.style.display = 'none';
        }
        return;
    }
    
    footer.style.display = 'block';
    let total = 0;
    let tablaHTML = `
        <table class="tabla-carrito">
            <thead>
                <tr><th>Producto</th><th>Precio Unit.</th><th>Cantidad</th><th>Subtotal</th><th></th></tr>
            </thead>
            <tbody>`;
    carrito.forEach((item, index) => {
        const subtotal = item.precio * item.cantidad;
        total += subtotal;
        tablaHTML += `
            <tr>
                <td><strong>${item.nombre}</strong></td>
                <td>$${item.precio.toLocaleString()}</td>
                <td>${item.cantidad}</td>
                <td>$${subtotal.toLocaleString()}</td>
                <td><button class="btn-eliminar" onclick="eliminarItem(${index})">✕</button></td>
            </tr>`;
    });
    tablaHTML += `</tbody></table>`;
    contenedor.innerHTML = tablaHTML;
    montoTotal.innerText = `$${total.toLocaleString()}`;
}
function vaciarCarrito() {
    // 1. Eliminar los datos del carrito en el navegador
    localStorage.removeItem('carrito');
    
    // 2. Actualizar la interfaz
    actualizarContadorCarrito();
    
    // 3. Si estás en la página del carrito, recargar la vista
    if (document.getElementById('contenido-carrito')) {
        cargarCarrito();
    }
}

// 3. Otras funciones
function eliminarItem(index) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    carrito.splice(index, 1);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    cargarCarrito();
    actualizarContadorCarrito();
}

function vaciarCarrito() {
    if(confirm("¿Seguro que quieres vaciar el carrito?")) {
        localStorage.removeItem('carrito');
        cargarCarrito();
        actualizarContadorCarrito();
    }
}

function procesarPagoWebpay() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    if (carrito.length === 0) { alert("Vacío."); return; }
    
    let totalPuro = carrito.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
    
    // ... (tu código del overlay sigue igual aquí) ...
    window.location.href = "pagar.php?total=" + totalPuro;
}
    function agregarAlCarrito(nombre, precio, boton) {
            const inputCantidad = boton.parentElement.querySelector('.cantidad-input');
            const cantidad = parseInt(inputCantidad.value);
            if (isNaN(cantidad) || cantidad < 1) {
                alert("Por favor ingresa una cantidad válida");
                return;
            }

            const producto = {
                nombre: nombre,
                precio: precio,
                cantidad: cantidad
            };

            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            const existe = carrito.findIndex(item => item.nombre === nombre);

            if (existe !== -1) {
                carrito[existe].cantidad += cantidad;
            } else {
                carrito.push(producto);
            }

            localStorage.setItem('carrito', JSON.stringify(carrito));
            if (typeof actualizarContadorCarrito === 'function') {
        actualizarContadorCarrito();
    }
            alert(`¡Genial! Añadiste ${cantidad} unidad(es) de "${nombre}" al carrito.`);
            inputCantidad.value = 1;
        }
window.addEventListener('DOMContentLoaded', () => {
    actualizarContadorCarrito();
    if (typeof cargarCarrito === 'function') {
        cargarCarrito();
    }
});
