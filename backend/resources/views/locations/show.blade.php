<h1>Detalles de {{ $location->city }}</h1>

@if($location->image_url)
<img src="{{ $location->image_url }}" alt="{{ $location->city }}" style="max-width: 300px;">
@endif

<p><strong>Pais:</strong> {{ $location->country }}</p>
<p><strong>Continente:</strong> {{ $location->continent }}</p>
<p><strong>Clima:</strong> {{ $location->weather_type }}</p>
<p><strong>Descripcion:</strong> {{ $location->description }}</p>

<hr>
<h3>Servicios en la zona:</h3>
<ul>
    <li>Hoteles: {{ $location->hotels->count() }}</li>
    <li>Actividades: {{ $location->activities->count() }}</li>
</ul>

<br>
<a href="{{ route('locations.index') }}">Volver</a>