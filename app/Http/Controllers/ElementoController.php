<?php

namespace App\Http\Controllers;

use App\Models\Elemento;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class ElementoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Elemento::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nro_lia', 'like', "%{$search}%")
                  ->orWhere('nro_unsj', 'like', "%{$search}%")
                  ->orWhere('tipo', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }

        $elementos = $query->get();
        return view('elementos.index', compact('elementos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('elementos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nro_lia' => 'required|unique:elementos,nro_lia|max:25',
            'tipo' => 'required',
            'cantidad' => 'required|integer|min:1',
        ]);

        $elemento = Elemento::create($request->all());

        // Create initial movement
        Movimiento::create([
            'nro_lia' => $elemento->nro_lia,
            'nro_unsj' => $elemento->nro_unsj,
            'user_id' => 1, // Assuming admin or logged in user
            'estado' => 'ingresado',
            'ubicacion' => 'Lab FB', // Default location
            'fecha' => now(),
            'comentario' => 'Ingreso inicial',
        ]);

        return redirect()->route('elementos.index')->with('success', 'Elemento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $elemento = Elemento::findOrFail($id);
        $movimientos = $elemento->movimientos; // Assuming relationship exists
        return view('elementos.show', compact('elemento', 'movimientos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $elemento = Elemento::findOrFail($id);
        return view('elementos.edit', compact('elemento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipo' => 'required',
            'cantidad' => 'required|integer|min:1',
        ]);

        $elemento = Elemento::findOrFail($id);
        $elemento->update($request->all());

        return redirect()->route('elementos.index')->with('success', 'Elemento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $elemento = Elemento::findOrFail($id);
        $elemento->delete();

        return redirect()->route('elementos.index')->with('success', 'Elemento eliminado exitosamente.');
    }
}
