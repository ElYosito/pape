<?php

namespace App\Http\Controllers;

use App\Models\detalle_venta;
use App\Models\estadisticas;
use App\Models\inventario;
use App\Models\venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Carbon::setLocale('es');

        $inventarios = Inventario::all();
        $detalles = detalle_venta::all();
        $ventas = Venta::all();

        // Calcular el total de ventas del día
        $ventasHoy = Venta::whereDate('fecha', now()->toDateString())->sum('total');

        // Calcular el total de ventas de la semana
        $ventasSemana = Venta::whereBetween('fecha', [now()->startOfWeek(), now()->endOfWeek()])->sum('total');

        // Calcular el total de ventas del mes
        $ventasMes = Venta::whereMonth('fecha', now()->month)->sum('total');

        $fechasUnicas = $ventas->unique(function ($venta) {
            return Carbon::parse($venta->fecha)->format('Y-m-d'); // Usar toda la fecha para garantizar la unicidad
        })->map(function ($venta) {
            return [
                'id' => Carbon::parse($venta->fecha)->format('d-m-Y'), // Usar día, mes, y año como ID única
                'fecha_formateada' => Carbon::parse($venta->fecha)->locale('es')->translatedFormat('l j \\d\\e F \\d\\e\\l Y')
            ];
        });

        $mesesUnicos = $ventas->unique(function ($venta) {
            return Carbon::parse($venta->fecha)->format('Y-m'); // Agrupar por año y mes
        })->map(function ($venta) {
            return [
                'id' => Carbon::parse($venta->fecha)->format('Y-m'), // Usar año-mes como valor
                'mes_formateado' => Carbon::parse($venta->fecha)->locale('es')->translatedFormat('F \\d\\e Y') // Formatear mes y año en español
            ];
        });

        $añosUnicos = $ventas->unique(function ($venta) {
            return Carbon::parse($venta->fecha)->format('Y'); // Agrupar por año
        })->map(function ($venta) {
            return [
                'id' => Carbon::parse($venta->fecha)->format('Y'), // Usar el año como valor
                'año_formateado' => Carbon::parse($venta->fecha)->format('Y') // Formatear el año
            ];
        });

        // Pasar los datos a la vista
        return view('estadisticas.index', compact('inventarios', 'detalles', 'ventas', 'ventasHoy', 'ventasSemana', 'ventasMes', 'fechasUnicas', 'mesesUnicos', 'añosUnicos'));
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
        DB::table('detalle_ventas')->delete();
        DB::table('ventas')->delete();

        return redirect()->back()->with('success', 'Todas las ventas han sido borradas correctamente.');
    }
}
