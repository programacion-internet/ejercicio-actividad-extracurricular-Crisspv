@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Próximos Eventos</h1>

    @foreach ($eventos as $evento)
        <div class="card mt-3">
            <div class="card-body">
                <h3>{{ $evento->nombre }}</h3>
                <p>{{ $evento->descripcion }}</p>
                <p><strong>Fecha:</strong> {{ $evento->fecha->format('d/m/Y') }}</p>
                <a href="{{ route('eventos.show', $evento) }}" class="btn btn-primary">Ver Detalle</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
