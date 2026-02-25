<h1>Detalle de la Reserva #{{ $reservation->id }}</h1>

<p><strong>Estado:</strong> {{ $reservation->status }}</p>
<p><strong>Fecha de creación:</strong> {{ $reservation->created_at->format('d/m/Y H:i') }}</p>
<p><strong>Cliente:</strong> {{ $reservation->user->name }} ({{ $reservation->user->email }})</p>

<hr>

<h3>Reserva:</h3>
<ul>
    @if($reservation->package)
    <li><strong>Paquete:</strong> {{ $reservation->package->name }}</li>
    @endif

    @if($reservation->hotel)
    <li><strong>Hotel:</strong> {{ $reservation->hotel->name }}</li>
    @endif

    @if($reservation->flight)
    <li><strong>Vuelo:</strong> Vuelo {{ $reservation->flight->airline }} (Origen: {{ $reservation->flight->origin }})
    </li>
    @endif
</ul>

<h2>Total: {{ $reservation->price }}€</h2>

<br>
<a href="{{ route('reservations.index') }}">Volver al listado</a>