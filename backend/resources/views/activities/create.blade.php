<h1>Añadir Nueva Actividad</h1>

@include('partials.alerts')

<form action="{{ route('activities.store') }}" method="POST">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <br><br>

    <label>Ubicacion:</label>
    <select name="location_id" required>
        <option value="">Selecciona una ubicacion</option>
        @foreach($locations as $location)
        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
            {{ $location->city }}, {{ $location->country }}
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Descripcion:</label>
    <textarea name="description" required>{{ old('description') }}</textarea>
    <br><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="price" value="{{ old('price') }}" required>
    <br><br>

    <button type="submit">Guardar Actividad</button>
</form>

<br>
<a href="{{ route('activities.index') }}">Cancelar y volver</a>