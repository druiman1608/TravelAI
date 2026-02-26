<h1>Listado de actividades:</h1>
<p><a href="{{ route('dashboard') }}">Volver al Dashboard</a></p>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('activities.create') }}">Crear nueva actividad</a></p>
@endif
<hr>
<br>
@include('activities._list')