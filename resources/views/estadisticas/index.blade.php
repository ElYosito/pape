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
    <h1 class="text-center">Información sobre la venta</h1>
    <div class="container">
        <h3>Venta total de hoy: ${{ number_format($ventasHoy, 2) }}</h3>
    </div>


    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center" id="cajasContainer">
            @foreach($ventas as $venta)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{asset('img/logo.png')}}" class="card-img-top" alt="Imagen del inventario" style="object-fit: cover; height: 150px;">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Venta #{{ $venta->id_venta }}</h4>
                        <h6><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fecha)->locale('es')->translatedFormat('j \d\e F \d\e Y') }} a las {{ \Carbon\Carbon::parse($venta->hora)->locale('es')->format('g:i A') }}</h6>
                        <hr>
                        <ul class="list-unstyled">
                            @foreach($venta->detalleVentas as $detalle)
                            <li>
                                <strong>Producto:</strong> {{ $detalle->inventario->producto->nombre }}<br>
                                <strong>Cantidad:</strong> {{ $detalle->cantidad }} Piezas<br>
                                <strong>Precio Unitario:</strong> ${{ $detalle->precio_unitario }} Pesos<br>
                                <strong>Subtotal:</strong> {{$detalle->subtotal}} Pesos
                                <hr>
                            </li>
                            @endforeach
                        </ul>
                        <h3 class="text-center text-success">Total: ${{ $venta->total }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>
@endsection