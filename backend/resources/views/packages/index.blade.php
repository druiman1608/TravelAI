<h1>Catalogo de Paquetes</h1>
<p><a href="{{ route('dashboard') }}">Volver al Dashboard</a></p>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('packages.create') }}">Crear nuevo paquete</a></p>
@endif
<hr>
<br>
@include('packages._list')