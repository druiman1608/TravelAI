<h1>Editar Usuario: {{ $user->name }}</h1>

@include('partials.alerts')

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf @method('PUT')

    <label>Nombre:</label><br>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    <br><br>

    <label>Contraseña:</label><br>
    <p style="color: red;">*Si no quiere ser cambiada simplemente no llenar este campo*</p>
    <input type="password" name="password">
    <br><br>

    <label>Confirmar Contraseña:</label><br>
    <input type="password" name="password_confirmation">
    <br><br>

    @if(auth()->user()->isAdmin())
    <label>Rol:</label><br>
    <select name="role_id" required>
        @foreach($roles as $role)
        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
            {{ $role->name }}
        </option>
        @endforeach
    </select>
    @endif
    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="{{ route('users.index') }}">Cancelar y volver</a>