<?php

namespace App\Http\Controllers;

use App\Models\Evidencia;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class EvidenciaController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Evento $evento)
    {
        $this->authorize('create', [Evidencia::class, $evento]);

        $request->validate([
            'archivo' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx',
        ]);

        $path = $request->file('archivo')->store('evidencias');

        Evidencia::create([
            'evento_id' => $evento->id,
            'user_id' => Auth::id(),
            'archivo' => $path,
        ]);

        return back()->with('success', 'Evidencia subida correctamente.');
    }

    public function destroy(Evidencia $evidencia)
    {
        $this->authorize('delete', $evidencia);
    
        Storage::delete($evidencia->archivo);
        $evidencia->delete();
    
        return back()->with('success', 'Evidencia eliminada correctamente.');
    }
}
