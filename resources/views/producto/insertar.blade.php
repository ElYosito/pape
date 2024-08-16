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

    <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="text-center mt-3">Registro de Ingreso de los productos</h4>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre" required>
                    <label for="nombre">Nombre:</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="nummber" class="form-control" id="precio_unitario" name="precio_unitario" placeholder="Ingresa el precio unitario" required>
                    <label for="precio_unitario">Precio unitario:</label>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Ingresa la descripción" id="descripcion" name="descripcion" style="height: 100px"></textarea>
            <label for="descripcion">Descripción:</label>
        </div>

        <div class="text-center mt-4">
            <button style="height: 50px;" class="btn btn-success" type="submit">Agregar producto</button>
        </div>
    </form>
</div>
@endsection