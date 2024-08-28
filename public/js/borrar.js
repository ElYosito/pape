function confirmarBorrarVentas(event) {
    event.preventDefault(); // Prevenir la acción por defecto del enlace

    // Mostrar el cuadro de confirmación
    const confirmado = confirm('¿Está seguro de que desea borrar todas las ventas?');

    if (confirmado) {
        // Si el usuario confirma, redirigir a la ruta de borrado
        window.location.href = '/venta/borrar'; // Asegúrate de que esta ruta sea correcta
    }
}