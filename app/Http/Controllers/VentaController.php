<?php

namespace App\Http\Controllers;

use App\Models\detalle_venta;
use App\Models\inventario;
use App\Models\producto;
use App\Models\venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ventas = new venta();
        $inventarios = inventario::all();
        $detalles = detalle_venta::all();
        return view('ventas.venta', compact('ventas', 'inventarios', 'detalles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'id_inventario' => 'nullable|array', // Asegúrate de recibir un array de inventarios
            'cantidad' => 'nullable|array', // Asegúrate de recibir un array de cantidades
            'precio_unitario' => 'nullable|array', // Asegúrate de recibir un array de precios unitarios
            'subtotal' => 'nullable|array', // Asegúrate de recibir un array de subtotales
            'fecha' => 'nullable|date',
            'hora' => 'nullable|date_format:H:i',
            'total' => 'nullable|numeric'
        ]);

        // Verificar que haya suficiente inventario
        foreach ($validatedData['id_inventario'] as $key => $idInventario) {
            $cantidadSolicitada = $validatedData['cantidad'][$key];
            $inventario = Inventario::find($idInventario);

            if ($cantidadSolicitada > $inventario->cantidad_total) {
                return redirect()->route('venta.create')->withErrors([
                    'inventario' => "No hay suficiente inventario para el producto: {$inventario->producto->nombre}. Disponible: {$inventario->cantidad_total}, Solicitado: {$cantidadSolicitada}."
                ]);
            }
        }

        // Insertar en la tabla ventas
        $venta = new Venta();
        $venta->fecha = $validatedData['fecha'];
        $venta->hora = $validatedData['hora'];
        $venta->total = $validatedData['total'];
        $venta->save();

        // Obtener el ID de la venta recién creada
        $idVenta = $venta->id_venta;

        // Insertar en la tabla detalle_ventas
        foreach ($validatedData['id_inventario'] as $key => $idInventario) {
            $detalleVenta = new detalle_venta();
            $detalleVenta->id_venta = $idVenta;
            $detalleVenta->id_inventario = $idInventario;
            $detalleVenta->cantidad = $validatedData['cantidad'][$key];
            $detalleVenta->precio_unitario = $validatedData['precio_unitario'][$key];
            $detalleVenta->subtotal = $validatedData['subtotal'][$key];
            $detalleVenta->save();

            // Actualizar el inventario
            $inventario = Inventario::find($idInventario);
            $inventario->cantidad_total -= $detalleVenta->cantidad;
            $inventario->save();
        }

        return redirect()->route('venta.create')->with('success', 'Compra realizada correctamente');
    }




    /**
     * Display the specified resource.
     */
    public function show(venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(venta $venta)
    {
        //
    }
}
