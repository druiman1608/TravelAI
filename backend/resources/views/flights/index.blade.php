<h1>Listado de vuelos:</h1>
<p><a href="{{ route('dashboard') }}">Volver al Dashboard</a></p>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('flights.create') }}">Crear nuevo vuelo</a></p>
@endif
<hr>
<br>
@include('flights._list')