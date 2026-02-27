<link rel="stylesheet" href="{{ asset('css/_lists/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Correo Electronico</th>
            <th>Rol del Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>#{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <strong>{{ $user->role->name ?? 'Sin Rol' }}</strong>
            </td>
            <td>
                <a href="{{ route('users.show', $user->id) }}">Ver</a>

                @if(auth()->user()->isAdmin() || auth()->id() == $user->id)
                | <a href="{{ route('users.edit', $user->id) }}">Editar</a>
                @endif

                @if(auth()->user()->isAdmin() && auth()->id() !== $user->id)
                | <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('¿Seguro de que deseas eliminar este usuario?')">Eliminar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($users->isEmpty())
<p>No hay usuarios registrados en el sistema.</p>
@endif