<h1>Detalle del Rol: {{ $role->name }}</h1>

<a href="{{ route('roles.index') }}">Volver al listado</a>
<hr>

<section style="display: flex; gap: 50px;">
    <div style="flex: 1; border: 1px solid #ccc; padding: 20px;">
        <h3>Editar nombre del rol</h3>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nombre:</label><br>
            <input type="text" name="name" value="{{ old('name', $role->name) }}">
            @error('name') <p style="color: red;">{{ $message }}</p> @enderror

            <br><br>
            <button type="submit">Actualizar nombre</button>
        </form>
    </div>

    <div style="flex: 1;">
        <h3>Usuarios con este rol ({{ $role->users->count() }})</h3>
        @if($role->users->isEmpty())
        <p>No hay usuarios asignados a este rol.</p>
        @else
        <ul>
            @foreach($role->users as $user)
            <li>
                <strong>{{ $user->name }}</strong> ({{ $user->email }})
                <a href="{{ route('users.show', $user->id) }}">Ver usuario</a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</section>

<hr>

@if($role->name !== 'Administrador')
<form action="{{ route('roles.destroy', $role->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" style="color: red;" onclick="return confirm('¿Estas seguro de eliminar este rol?')">
        Eliminar rol
    </button>
</form>
@endif

<br>
<a href="{{ route('roles.index') }}">Volver</a>