<h1>Detalles de la Actividad</h1>

<p><strong>ID:</strong> {{ $activity->id }}</p>
<p><strong>Nombre:</strong> {{ $activity->name }}</p>
<p><strong>Ubicacion:</strong> {{ $activity->location->city }}, {{ $activity->location->country }}</p>
<p><strong>Descripcion:</strong> {{ $activity->description }}</p>
<p><strong>Precio:</strong> {{ $activity->price }}€</p>

<br>

@if(auth()->user()->isAdmin())
<a href="{{ route('activities.edit', $activity->id) }}">Editar Actividad</a>
@endif

<br><br>
<a href="{{ route('activities.index') }}">Volver al listado</a>