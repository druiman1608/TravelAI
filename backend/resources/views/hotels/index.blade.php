<h1>Listado de hoteles:</h1>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('hotels.create') }}">Crear nuevo hotel</a></p>
@endif
@include('hotels._list')

<br>
<a href="{{ route('dashboard') }}">Volver al Dashboard</a>