<p>Hola {{ Auth::user()->name }},</p>

<p>Te has inscrito al evento <strong>{{ $evento->nombre }}</strong> que se llevará a cabo el día <strong>{{ $evento->fecha->format('d/m/Y') }}</strong>.</p>

<p>¡Gracias por participar!</p>
