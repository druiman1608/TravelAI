<h1>Detalles: {{$hotel->name}}</h1>

<p><strong>ID:</strong> {{$hotel->id}}</p>
<p><strong>Nombre:</strong> {{$hotel->name}}</p>
<p><strong>Descripción:</strong> {{$hotel->description}}</p>
<p><strong>Estrellas:</strong> {{$hotel->stars}}</p>
<p><strong>Ubicación:</strong> {{$hotel->location->city}}, {{$hotel->location->country}}</p>
<p><strong>Precio por noche:</strong> {{$hotel->price_per_night}}</p>

<br><br>
<p><a href="{{ route('hotels.index') }}">Volver al listado</a></p>
<br>
<p><a href="{{ route('hotels.edit', $hotel->id) }}">Editar hotel</a></p>