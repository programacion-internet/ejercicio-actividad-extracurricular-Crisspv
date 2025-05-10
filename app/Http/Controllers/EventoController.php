<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Http\Requests\StoreEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Mail\InscripcionEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EventoController extends Controller
{
    public function __construct()
    {
        // Solo usuarios autenticados pueden acceder a estas acciones
        $this->middleware('auth')->only(['show', 'inscribirse']);
    }

    /**
     * Muestra el listado de eventos futuros.
     */
    public function index()
    {
        $eventos = Evento::whereDate('fecha', '>=', now())->orderBy('fecha')->get();
        return view('eventos.index', compact('eventos'));
    }

    /**
     * Muestra el detalle de un evento.
     */
    public function show(Evento $evento)
    {
        $usuario = Auth::user();
        $inscrito = false;

        if ($usuario && $usuario->role === 'alumno') {
            $inscrito = $evento->alumnos()->where('user_id', $usuario->id)->exists();
        }

        return view('eventos.show', compact('evento', 'inscrito'));
    }

    /**
     * Inscribe al alumno en un evento.
     */
    public function inscribirse(Request $request, Evento $evento)
    {
        $user = Auth::user();

        if ($user->role !== 'alumno') {
            abort(403, 'Solo los alumnos pueden inscribirse.');
        }

        // Verificar si ya está inscrito
        if ($evento->alumnos()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Ya estás inscrito a este evento.');
        }

        // Relacionar en tabla pivote
        $evento->alumnos()->attach($user->id);

        // Enviar correo de confirmación
        Mail::to($user)->send(new InscripcionEvento($evento));

        return back()->with('success', 'Te has inscrito al evento y se ha enviado un correo de confirmación.');
    }

    // Métodos vacíos generados por el resource (puedes implementarlos más tarde)

    public function create()
    {
        //
    }

    public function store(StoreEventoRequest $request)
    {
        //
    }

    public function edit(Evento $evento)
    {
        //
    }

    public function update(UpdateEventoRequest $request, Evento $evento)
    {
        //
    }

    public function destroy(Evento $evento)
    {
        //
    }
}
