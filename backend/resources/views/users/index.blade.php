<h1>Listado de usuarios:</h1>
<p><a href="{{ route('users.create') }}">Crear nuevo usuario</a></p>
@include('users._list')

<br>
<a href="{{ route('dashboard') }}">Volver al Dashboard</a>