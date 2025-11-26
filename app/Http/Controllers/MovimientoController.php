<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Elemento;
use App\Models\Usuario;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->hasRole('coordinador')) {
            abort(403, 'No tienes permiso para ver esta página.');
        }

        $movimientos = Movimiento::with(['elemento', 'usuario'])->orderBy('fecha', 'desc')->get();
        return view('movimientos.index', compact('movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $elementos = Elemento::all();
        $usuarios = Usuario::all();
        $nro_lia = $request->query('nro_lia');
        return view('movimientos.create', compact('elementos', 'usuarios', 'nro_lia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nro_lia' => 'required|exists:elementos,nro_lia',
            'estado' => 'required|in:ingresado,guardado,funcionando,dado de baja,prestado',
            'ubicacion' => 'nullable|string',
            'fecha' => 'required|date',
            'comentario' => 'nullable|string',
        ]);

        $fecha = $request->fecha;
        if (!auth()->user()->can('manage-movements')) {
            $fecha = now();
        }

        Movimiento::create([
            'nro_lia' => $request->nro_lia,
            'user_id' => auth()->id(),
            'estado' => $request->estado,
            'ubicacion' => $request->ubicacion,
            'fecha' => $fecha,
            'comentario' => $request->comentario,
        ]);

        return redirect()->route('movimientos.index')->with('success', 'Movimiento registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not typically needed for movements, but can be implemented if required
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movimiento = Movimiento::findOrFail($id);
        $elementos = Elemento::all();
        $usuarios = Usuario::all();
        return view('movimientos.edit', compact('movimiento', 'elementos', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nro_lia' => 'required|exists:elementos,nro_lia',
            'user_id' => 'required|exists:usuarios,id',
            'estado' => 'required',
            'fecha' => 'required|date',
        ]);

        $movimiento = Movimiento::findOrFail($id);
        $movimiento->update($request->all());

        return redirect()->route('movimientos.index')->with('success', 'Movimiento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movimiento = Movimiento::findOrFail($id);
        $movimiento->delete();

        return redirect()->route('movimientos.index')->with('success', 'Movimiento eliminado exitosamente.');
    }
}
