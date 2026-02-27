<h1>Detalles del Vuelo</h1>
<p><strong>ID:</strong> {{ $flight->id }}</p>
<p><strong>Aerolinea:</strong> {{ $flight->airline }}</p>
<p><strong>Ruta:</strong> {{ $flight->origin }} -> {{ $flight->location->city }}</p>
<p><strong>Salida:</strong> {{ $flight->departure }}</p>
<p><strong>Llegada:</strong> {{ $flight->arrival }}</p>
<p><strong>Precio:</strong> {{ $flight->price }}€</p>

@if(auth()->user()->isAdmin())
<p><a href="{{ route('flights.edit', $flight->id) }}">Editar vuelo</a></p>
@endif

<br>
<a href="{{ route('flights.index') }}">Volver</a>