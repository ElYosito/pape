<?php

namespace App\Http\Controllers;

use App\Models\detalle_venta;
use App\Models\reporte;
use App\Models\venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalles = detalle_venta::all();
        $ventas = venta::withCount('detalleVentas')->get();

        // Obtener el primer y último día del mes actual
        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();

        // Calcular el total de ventas del mes actual
        $ventaTotalMes = venta::whereBetween('fecha', [$inicioMes, $finMes])->sum('total');

        return view('reporte.index', compact('detalles', 'ventas', 'ventaTotalMes'));
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
    public function show(reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reporte $reporte)
    {
        //
    }
}
