<h1>Detalles del Hotel: {{ $hotel->name }}</h1>

<p><strong>ID:</strong> {{ $hotel->id }}</p>
<p><strong>Estrellas:</strong> {{ $hotel->stars }}</p>
<p><strong>Ubicacion:</strong> {{ $hotel->location->city }}, {{ $hotel->location->country }}</p>
<p><strong>Precio por noche:</strong> {{ $hotel->price_per_night }}€</p>
<p><strong>Descripcion:</strong></p>
<p>{{ $hotel->description }}</p>

<br>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('hotels.edit', $hotel->id) }}">Editar hotel</a></p>
@endif

<br>
<a href="{{ route('hotels.index') }}">Volver</a>