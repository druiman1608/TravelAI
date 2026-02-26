<h1>Listado de usuarios:</h1>
<p><a href="{{ route('dashboard') }}">Volver al Dashboard</a></p>
<p><a href="{{ route('users.create') }}">Registrar Nuevo Usuario</a></p>
<hr>
<br>
@include('users._list')