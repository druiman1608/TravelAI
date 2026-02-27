<h1>Editar Rol: {{ $role->name }}</h1>

@include('partials.alerts')

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf @method('PUT')
    <label>Nombre del Rol:</label>
    <input type="text" name="name" value="{{ old('name', $role->name) }}">
    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="{{ route('roles.index') }}">Cancelar y volver</a>