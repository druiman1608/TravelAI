<h1>Gestionar Localizaciones:</h1>
<p><a href="{{ route('dashboard') }}">Volver al Dashboard</a></p>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('locations.create') }}">Añadir nueva localizacion</a></p>
@endif
<hr>
<br>
@include('locations._list')