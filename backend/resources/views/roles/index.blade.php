<h1>Gestion de Roles</h1>
<p><a href="{{ route('dashboard') }}">Volver al Dashboard</a></p>
<a href="{{ route('roles.create') }}">Crear Nuevo Rol</a>
<br><br>

@if(session('success'))
<div style="color: green; font-weight: bold;">{{ session('success') }}</div>
@endif

@if(session('error'))
<div style="color: red; font-weight: bold;">{{ session('error') }}</div>
@endif

@include('roles._list')