<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use App\Models\inventario_historial;
use App\Models\producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');
        $productos = producto::all();
        $inventarios = inventario::all()->map(function ($inventario) {
            $inventario->fecha = Carbon::parse($inventario->fecha)->translatedFormat('l, d \d\e F \d\e Y');
            $inventario->hora = Carbon::parse($inventario->hora)->format('g:i A');
            return $inventario;
        });

        $historiales = inventario_historial::all()->map(function ($historial) {
            $historial->fecha = Carbon::parse($historial->fecha)->translatedFormat('l, d \d\e F \d\e Y');
            $historial->hora = Carbon::parse($historial->hora)->format('g:i A');
            return $historial;
        });
        

        return view('index', compact('productos', 'inventarios', 'historiales'));
    }

    public function create()
    {
        $inventarios = new inventario();
        $productos = producto::all();
        return view('inventario.insertar', compact('productos', 'inventarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'nullable|date',
            'hora' => 'nullable|date_format:H:i',
            'cantidad_ingresada' => 'nullable|numeric',
            'cantidad_total' => 'nullable',
            'id_producto' => 'required|exists:productos,id_producto'
        ]);

        // Buscar el inventario del producto por su ID
        $inventario = Inventario::where('id_producto', $request->id_producto)->first();

        if ($inventario) {
            // Si ya existe un registro de inventario para este producto, actualizar la cantidad total
            $inventario->cantidad_total += $request->cantidad_ingresada;
        } else {
            // Si no existe, crear un nuevo registro de inventario
            $inventario = new Inventario();
            $inventario->fecha = $request->fecha;
            $inventario->hora = $request->hora;
            $inventario->cantidad_ingresada = $request->cantidad_ingresada;
            $inventario->cantidad_total = $request->cantidad_ingresada;
            $inventario->id_producto = $request->id_producto;
        }

        // Guardar el registro de inventario
        $inventario->save();

        // Crear y guardar el historial del inventario
        $historial = new inventario_historial();
        $historial->fecha = $request->fecha;
        $historial->hora = $request->hora;
        $historial->cantidad_ingresada = $request->cantidad_ingresada;
        $historial->id_inventario = $inventario->id_inventario;
        $historial->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('inventario.index')->with('success', 'Inventario actualizado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inventario $inventario)
    {
        //
    }
}
