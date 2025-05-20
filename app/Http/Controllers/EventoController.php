<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::where('fecha', '>=', now())->get();
        return view('eventos.index', compact('eventos'));
    }

    public function show(Evento $evento)
    {
        $inscrito = false;
        if (Auth::check()) {
            $inscrito = $evento->usuarios->contains(Auth::user());
        }
        return view('eventos.show', compact('evento', 'inscrito'));
    }

    public function inscribirse(Evento $evento)
    {
        Gate::authorize('inscribirse-evento', $evento);

        $user = Auth::user();

        if (Gate::denies('inscribirse-evento', $evento)) {
            abort(403);
        }

        $evento->usuarios()->attach($user->id);

        // Enviar correo de confirmación
        Mail::to($user->email)->send(new \App\Mail\InscripcionEvento($evento));

        return redirect()->route('eventos.show', $evento)->with('success', 'Te has inscrito al evento.');
    }
}
