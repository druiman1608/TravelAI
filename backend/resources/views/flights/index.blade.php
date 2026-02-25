<h1>Listado de vuelos:</h1>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('flights.create') }}">Crear nuevo vuelo</a></p>
@endif
@include('flights._list')

<br>
<a href="{{ route('dashboard') }}">Volver al Dashboard</a>