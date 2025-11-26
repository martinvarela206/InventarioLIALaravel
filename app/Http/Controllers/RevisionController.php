<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Elemento;

class RevisionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if (!$user || !$user->hasRole('revisor')) {
            return view('revision.welcome');
        }

        $query = Elemento::with('ultimoMovimiento');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nro_lia', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%")
                  ->orWhereHas('ultimoMovimiento', function ($q) use ($search) {
                      $q->where('ubicacion', 'like', "%{$search}%");
                  });
            });
        }

        $elementos = $query->get();
        return view('revision.index', compact('elementos'));
    }
}
