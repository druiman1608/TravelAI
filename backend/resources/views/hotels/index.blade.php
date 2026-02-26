<h1>Listado de hoteles:</h1>
<p><a href="{{ route('dashboard') }}">Volver al Dashboard</a></p>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('hotels.create') }}">Crear nuevo hotel</a></p>
@endif
<hr>
<br>
@include('hotels._list')