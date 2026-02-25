<h1>Listado de actividades:</h1>

@if(auth()->user()->isAdmin())
<p><a href="{{ route('activities.create') }}">Crear nueva actividad</a></p>
@endif

@include('activities._list')

<br>
<a href="{{ route('dashboard') }}">Volver al Dashboard</a>