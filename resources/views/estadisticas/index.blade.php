@extends("plantillas.plantilla1")

@section("con1")
<style>
    .contenedor {
        margin: 120px auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow-x: auto;
        width: 90%;
    }
</style>

<div class="contenedor">
    <h1 class="text-center">Inventario</h1>
    <h3>Venta total de hoy: ${{ number_format($ventasHoy, 2) }}</h3>
</div>
@endsection