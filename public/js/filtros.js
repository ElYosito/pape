document.addEventListener('DOMContentLoaded', function() {
    // Obtén los elementos select
    const filtroDia = document.getElementById('filtro_dia');
    const filtroMes = document.getElementById('filtro_mes');
    const filtroAnio = document.getElementById('filtro_anio');

    // Evento para aplicar filtros
    filtroDia.addEventListener('change', filtrarTarjetas);
    filtroMes.addEventListener('change', filtrarTarjetas);
    filtroAnio.addEventListener('change', filtrarTarjetas);

    function filtrarTarjetas() {
        const dia = filtroDia.value;
        const mes = filtroMes.value;
        const anio = filtroAnio.value;

        // Obtén todas las tarjetas
        const tarjetas = document.querySelectorAll('.tarjeta');

        tarjetas.forEach(tarjeta => {
            // Obtén los atributos data de la tarjeta
            const tarjetaDia = tarjeta.getAttribute('data-dia');
            const tarjetaMes = tarjeta.getAttribute('data-mes');
            const tarjetaAnio = tarjeta.getAttribute('data-anio');

            // Compara los filtros con los atributos de las tarjetas
            const coincideDia = dia === '' || tarjetaDia === dia;
            const coincideMes = mes === '' || tarjetaMes === mes;
            const coincideAnio = anio === '' || tarjetaAnio === anio;

            // Mostrar u ocultar tarjetas
            if (coincideDia && coincideMes && coincideAnio) {
                tarjeta.style.display = 'block';
            } else {
                tarjeta.style.display = 'none';
            }
        });
    }
});