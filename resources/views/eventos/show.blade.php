@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $evento->nombre }}</h1>
    <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
    <p>{{ $evento->descripcion }}</p>

    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-2">
            {{ session('error') }}
        </div>
    @endif

    @auth
        @if ($inscrito)
        <h3>Subir evidencia</h3>
        <form action="{{ route('archivos.store', $evento) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="archivo" required>
            <button type="submit">Subir</button>
        </form>

        <h4>Mis archivos</h4>
        <ul>
            @foreach ($evento->archivosEvento->where('user_id', auth()->id()) as $archivo)
                <li>
                    <a href="{{ asset('storage/' . $archivo->ruta) }}" target="_blank">{{ basename($archivo->ruta) }}</a>
                    <form action="{{ route('archivos.destroy', $archivo) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    @endauth
</div>
@endsection
