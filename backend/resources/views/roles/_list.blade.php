<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del Rol</th>
            <th>Usuarios Asignados</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->users_count ?? $role->users->count() }}</td>
            <td>
                <a href="{{ route('roles.edit', $role->id) }}">Editar</a>

                @if($role->name !== 'Administrador')
                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('¿Seguro de qe quieres eliminar este rol? Esto tambien afectaria a los usuarios')">
                        Eliminar
                    </button>
                </form>
                @else
                <span style="color: gray;">[Protegido]</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>