<h1>Crear Usuario</h1>

@include('partials.alerts')

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label>Nombre:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required>
    <br><br>

    <label>Confirmar Contraseña:</label><br>
    <input type="password" name="password_confirmation" required>
    <br><br>

    <label>Rol:</label><br>
    <select name="role_id" required>
        <option value="">Seleccionar Rol</option>
        @foreach($roles as $role)
        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
            {{ $role->name }}
        </option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Guardar Usuario</button>
</form>

<br>
<a href="{{ route('users.index') }}">Cancelar y volver</a>