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

    main.table {
        height: auto;
        background-color: #fff5;

        backdrop-filter: blur(7px);
    }

    .table_header {
        width: 100%;
        height: 10%;
        background-color: #fff4;
    }

    .table_body {
        width: 95%;
        max-height: calc(89% - 1.6rem);
        background-color: #fffb;

        margin: .8rem auto;
        border-radius: .6rem;

        overflow: auto;
    }

    .table_body::-webkit-scrollbar {
        width: 0.5rem;
        height: 0.5rem;
    }

    .table_body::-webkit-scrollbar-thumb {
        border-radius: .5rem;
        background-color: #0004;
        visibility: hidden;
    }

    .table_body:hover::-webkit-scrollbar-thumb {
        visibility: visible;
    }

    table {
        width: 100%;
    }

    table,
    th,
    td {
        border-collapse: collapse;
        padding: 1rem;
        text-align: left;
    }

    thead th {
        position: sticky;
        top: 0;
        left: 0;
        background-color: #d5d1defe;
    }

    tbody tr:nth-child(even) {
        background-color: #0000000b;
    }

    tbody tr:hover {
        background-color: #fff6;
    }
</style>

<div class="contenedor">
    <div class="d-flex">
        <form action="{{ route('inventario.create') }}" method="get" class="me-3">
            <button type="submit" class="btn btn-warning">Agregar inventario</button>
        </form>

        <form action="{{ route('producto.create') }}" method="get">
            <button type="submit" class="btn btn-success">Agregar Productos</button>
        </form>
    </div>

    <h1 class="text-center">Inventario</h1>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-3 justify-content-center" id="cajasContainer">
            @foreach($inventarios as $inventario)
            <div class="col">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/papeleria.png"
                                alt="Imagen del producto"
                                class="img-fluid rounded-start"
                                style="object-fit: cover; width: 100%; height: 100%; border-radius: 5px 0 0 5px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $inventario->producto->nombre }}</h5>
                                <p style="margin-bottom: 0;">{{ $inventario->producto->descripcion }}</p>
                                <p><small class="text-body-secondary">Última actualización: {{ $inventario->fecha }} a las {{ $inventario->hora }}</small></p>
                                <h3 class="text-center">Total: {{ $inventario->cantidad_total }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <main class="table mt-3">
        <section class="table_header">
            <h1>Ingreso de los productos al inventario</h1>
        </section>
        <section class="table_body">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Precio unitario</th>
                        <th>Cantidad disponible</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historiales as $historial)
                    <tr class="clickable-row">
                        <th scope="row" data-label="nombre">{{ $historial->inventario->producto->nombre }}</th>
                        <td data-label="fecha">{{ $historial->fecha }}</td>
                        <td data-label="hora">{{ $historial->hora }}</td>
                        <td data-label="precio_unitario">${{ $historial->inventario->producto->precio_unitario }} Pesos</td>
                        <td data-label="cantidad_ingresada">{{ $historial->cantidad_ingresada }} Piezas</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</div>
@endsection