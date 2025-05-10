@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $evento->nombre }}</h1>
    <p>{{ $evento->descripcion }}</p>
    <p><strong>Fecha:</strong> {{ $evento->fecha->format('d/m/Y') }}</p>

    @auth
        @if (!$inscrito && Auth::user()->role === 'alumno')
            <form action="{{ route('eventos.inscribirse', $evento) }}" method="POST">
                @csrf
                <button class="btn btn-success">Inscribirme</button>
            </form>
        @elseif ($inscrito)
            <hr>
            <h3>Subir Evidencia</h3>
            <form action="{{ route('evidencias.store', $evento) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="archivo" required>
                <button class="btn btn-primary">Subir</button>
            </form>

            <h4 class="mt-4">Mis Evidencias</h4>
            <ul>
                @foreach ($evento->evidencias->where('user_id', Auth::id()) as $evidencia)
                    <li>
                        <a href="{{ Storage::url($evidencia->archivo) }}" target="_blank">{{ basename($evidencia->archivo) }}</a>
                        <form action="{{ route('evidencias.destroy', $evidencia) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    @else
        <p><a href="{{ route('login') }}">Inicia sesión</a> para inscribirte o subir evidencias.</p>
    @endauth
</div>
@endsection
