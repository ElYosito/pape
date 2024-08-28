<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/reporte.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Reporte financiero</title>
</head>

<body>
    <div class="d-flex justify-content-between align-items-center">
        <img height="100px" src="{{asset('img/logoCoronado.png')}}" alt="">

        <h3 class="text-center">La pape</h3>

        <img height="100px" src="{{asset('img/logo.png')}}" alt="">
    </div>

    <h3 class="text-center">Venta total del mes: <br> ${{ number_format($ventaTotalMes, 2) }}</h3>

    <main class="table mt-4">
        <section class="table_header">
            <h4>Reporte financiero del mes de {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('F Y') }}</h4>
        </section>
        <section class="table_body">
            <table>
                <thead>
                    <tr>
                        <th>Venta</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Cantidad de productos</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                    <tr class="clickable-row">
                        <td data-label="id_venta">Venta #{{$venta->id_venta}}</td>
                        <td data-label="fecha">{{ \Carbon\Carbon::parse($venta->fecha)->locale('es')->translatedFormat('j \d\e F \d\e Y') }}</td>
                        <td data-label="hora">{{ \Carbon\Carbon::parse($venta->hora)->format('h:i A') }}</td>
                        <td data-label="cantidad">{{ $venta->detalle_ventas_count }} Piezas</td>
                        <td data-label="Total">${{$venta->total}} Pesos</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>