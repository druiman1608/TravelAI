<h1>Detalles del Usuario</h1>
<ul>
    <li><strong>Nombre:</strong> {{ $user->name }}</li>
    <li><strong>Email:</strong> {{ $user->email }}</li>
    <li><strong>Rol:</strong> {{ $user->role->name ?? 'Sin Rol' }}</li>
    <li><strong>Fecha de Registro:</strong> {{ $user->created_at->format('d/m/Y') }}</li>
</ul>

<a href="{{ route('users.index') }}">Volver</a>