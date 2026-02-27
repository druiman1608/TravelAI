<h1>Crear Usuario</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label>Nombre:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required>
    @error('name') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required>
    @error('password') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Confirmar Contraseña:</label><br>
    <input type="password" name="password_confirmation" required>
    @error('password_confirmation') <div style="color:red">{{ $message }}</div> @enderror
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
    @error('role_id') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <button type="submit">Guardar Usuario</button>
</form>

<br>
<a href="{{ route('users.index') }}">Cancelar y volver</a>