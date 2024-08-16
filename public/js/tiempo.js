document.addEventListener("DOMContentLoaded", function() {
    // Obtener la fecha y hora actual
    var today = new Date();
    var day = String(today.getDate()).padStart(2, '0');
    var month = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
    var year = today.getFullYear();

    // Formatear la fecha en YYYY-MM-DD
    var currentDate = year + '-' + month + '-' + day;

    // Establecer el valor del campo de fecha
    document.getElementById('fecha').value = currentDate;

    // Obtener la hora actual
    var hours = String(today.getHours()).padStart(2, '0');
    var minutes = String(today.getMinutes()).padStart(2, '0');

    // Formatear la hora en HH:MM
    var currentTime = hours + ':' + minutes;

    // Establecer el valor del campo de hora
    document.getElementById('hora').value = currentTime;
});