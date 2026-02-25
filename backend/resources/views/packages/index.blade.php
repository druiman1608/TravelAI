<h1>Catalogo de Paquetes</h1>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('packages.create') }}">Crear nuevo paquete</a></p>
@endif
@include('packages._list')

<br>
<a href="{{ route('dashboard') }}">Volver al Dashboard</a>