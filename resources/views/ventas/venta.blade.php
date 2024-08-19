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

    @if ($errors->has('inventario'))
    <div class="alert alert-danger mt-3">
        {{ $errors->first('inventario') }}
    </div>
    @endif

    <form action="{{ route('venta.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="text-center mt-3">Venta del dia</h4>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Ingresa la fecha de ingreso del producto" readonly>
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

        <div class="container">
            <div id="product-forms">
                <div class="row product-form">
                    <div class="col">
                        <select style="height: 60px;" class="form-select" id="id_producto" name="id_inventario[]">
                            <option value="">Selecciona el producto</option>
                            @foreach($inventarios as $inventario)
                            <option value="{{ $inventario->id_inventario }}" data-precio="{{ $inventario->producto->precio_unitario }}">{{ $inventario->producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control cantidad" id="cantidad" name="cantidad[]" min="0">
                            <label for="cantidad">Cantidad:</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control precio-unitario" id="precio_unitario" name="precio_unitario[]" readonly>
                            <label for="precio_unitario">Precio unitario:</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control subtotal" id="subtotal" name="subtotal[]" readonly>
                            <label for="subtotal">Subtotal:</label>
                        </div>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger remove-product-btn">Quitar producto</button>
                    </div>
                </div>
            </div>
            <button type="button" id="add-product-btn" class="btn btn-success mt-3">Agregar producto</button>
        </div>

        <div class="text-center mt-3 d-flex justify-content-between align-items-center">
            <h1 class="text-center mt-4" id="total" name="total">Total: 0.00</h1>
            <input type="hidden" id="total-input" name="total" value="0.00">

            <div class="form-floating mt-4">
                <input type="number" class="form-control subtotal" id="pago" name="pago">
                <label for="subtotal">Pago con:</label>
            </div>

            <h1 class="text-center mt-4" id="cambio" name="cambio">Cambio: 0.00</h1>
            <button style="height: 50px;" class="btn btn-success" type="submit">Vender</button>
        </div>
    </form>

</div>

<script src="{{asset('js/tiempo.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addProductBtn = document.getElementById('add-product-btn');
        const productFormsContainer = document.getElementById('product-forms');
        const totalAmountElement = document.getElementById('total');

        // Función para agregar un nuevo formulario de producto
        function addProductForm() {
            const newForm = document.querySelector('.product-form').cloneNode(true);
            const inputs = newForm.querySelectorAll('input');
            const selects = newForm.querySelectorAll('select');

            // Limpiar los valores de los inputs y selects
            inputs.forEach(input => input.value = '');
            selects.forEach(select => select.selectedIndex = 0);

            // Añadir el nuevo formulario al contenedor
            productFormsContainer.appendChild(newForm);

            // Añadir el evento al botón de eliminar del nuevo formulario
            newForm.querySelector('.remove-product-btn').addEventListener('click', function() {
                removeProductForm(newForm);
            });

            // Añadir el evento change al nuevo select
            newForm.querySelector('select').addEventListener('change', function() {
                updatePrice(newForm);
            });

            // Añadir el evento input al nuevo campo de cantidad
            newForm.querySelector('.cantidad').addEventListener('input', function() {
                updateSubtotal(newForm);
            });
        }

        // Función para eliminar un formulario de producto
        function removeProductForm(form) {
            form.remove();
            updateTotal();
        }

        // Función para actualizar el precio unitario
        function updatePrice(form) {
            const select = form.querySelector('select');
            const precioInput = form.querySelector('.precio-unitario');

            // Obtener el precio del producto seleccionado
            const selectedOption = select.options[select.selectedIndex];
            const precio = selectedOption.getAttribute('data-precio');

            // Establecer el precio en el campo correspondiente
            precioInput.value = precio || '';
            // Actualizar el subtotal al cambiar el precio
            updateSubtotal(form);
        }

        // Función para actualizar el subtotal
        function updateSubtotal(form) {
            const cantidadInput = form.querySelector('.cantidad');
            const precioInput = form.querySelector('.precio-unitario');
            const subtotalInput = form.querySelector('.subtotal');

            // Obtener los valores de cantidad y precio unitario
            const cantidad = parseFloat(cantidadInput.value) || 0;
            const precio = parseFloat(precioInput.value) || 0;

            // Calcular el subtotal
            const subtotal = cantidad * precio;

            // Establecer el subtotal en el campo correspondiente
            subtotalInput.value = subtotal.toFixed(2);
            // Actualizar el total
            updateTotal();
        }

        // Función para actualizar el total de todos los subtotales
        function updateTotal() {
            let total = 0;

            // Iterar sobre todos los campos de subtotal y sumar sus valores
            document.querySelectorAll('.subtotal').forEach(input => {
                total += parseFloat(input.value) || 0;
            });

            // Actualizar el total en el elemento correspondiente
            totalAmountElement.textContent = `Total: $${total.toFixed(2)}`;

            // Actualizar el valor del input oculto
            document.getElementById('total-input').value = total.toFixed(2);
        }

        // Evento para agregar un nuevo formulario al hacer clic en "Agregar producto"
        addProductBtn.addEventListener('click', addProductForm);

        // Añadir eventos de eliminar a los formularios iniciales
        document.querySelectorAll('.remove-product-btn').forEach(button => {
            button.addEventListener('click', function() {
                removeProductForm(button.closest('.product-form'));
            });
        });

        // Añadir eventos change a los selects iniciales
        document.querySelectorAll('.product-form select').forEach(select => {
            select.addEventListener('change', function() {
                updatePrice(select.closest('.product-form'));
            });
        });

        // Añadir eventos input a los campos de cantidad iniciales
        document.querySelectorAll('.product-form .cantidad').forEach(input => {
            input.addEventListener('input', function() {
                updateSubtotal(input.closest('.product-form'));
            });
        });

        // Inicializar el total al cargar la página
        updateTotal();
    });
</script>
<script>
    // Obtén los elementos necesarios
    const totalElement = document.getElementById('total');
    const totalInput = document.getElementById('total-input');
    const pagoInput = document.getElementById('pago');
    const cambioElement = document.getElementById('cambio');

    // Función para calcular el cambio
    function calcularCambio() {
        const total = parseFloat(totalInput.value); // Obtén el total como un número
        const pago = parseFloat(pagoInput.value); // Obtén el pago como un número

        if (!isNaN(total) && !isNaN(pago)) {
            const cambio = pago - total; // Calcula el cambio
            cambioElement.innerText = `Cambio: $${cambio.toFixed(2)}`; // Muestra el cambio en el elemento
        }
    }

    // Agrega un evento de escucha al campo de pago para que calcule el cambio cada vez que cambie el valor
    pagoInput.addEventListener('input', calcularCambio);
</script>
@endsection