<h1>Crear Rol</h1>

@include('partials.alerts')

<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <label>Nombre del Rol:</label>
    <input type="text" name="name" value="{{ old('name') }}">
    <br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href="{{ route('roles.index') }}">Cancelar y volver</a>