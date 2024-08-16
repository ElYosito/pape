<?php

namespace App\Http\Controllers;

use App\Models\detalle_venta;
use App\Models\estadisticas;
use App\Models\inventario;
use App\Models\venta;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventarios = Inventario::all();
        $detalles = detalle_venta::all();
        $ventas = Venta::all();

        // Calcular el total de ventas del día
        $ventasHoy = Venta::whereDate('fecha', now()->toDateString())
            ->sum('total');

        // Pasar los datos a la vista
        return view('estadisticas.index', compact('inventarios', 'detalles', 'ventas', 'ventasHoy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(estadisticas $estadisticas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(estadisticas $estadisticas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, estadisticas $estadisticas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(estadisticas $estadisticas)
    {
        //
    }
}
