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
    <div class="d-flex">
        <a class="btn btn-danger" href="/">
            <img height="30px" src="{{ asset('img/atras.png') }}" alt=""> Regresar
        </a>
    </div>

    <form action="{{ route('inventario.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="text-center mt-3">Registro de Ingreso del inventario</h4>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Ingresa la fecha de ingreso del producto">
                    <label for="fecha">Fecha:</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" id="hora" name="hora" readonly>
                    <label for="hora">Hora:</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <select style="height: 60px;" class="form-select" id="id_producto" name="id_producto">
                    <option value="">Selecciona el producto</option>
                    @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="cantidad_ingresada" name="cantidad_ingresada" placeholder="Ingresa la cantidad disponible">
                    <label for="cantidad_ingresada">Cantidad ingresada:</label>
                </div>
            </div>
        </div>

        <div class="text-center mt-3">
            <button style="height: 50px;" class="btn btn-success" type="submit">Insertar</button>
        </div>
    </form>
</div>

<script src="{{asset('js/tiempo.js')}}"></script>
@endsection