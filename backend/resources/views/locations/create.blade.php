<h1>Añadir Nueva Localizacion</h1>

@include('partials.alerts')

<form action="{{ route('locations.store') }}" method="POST">
    @csrf

    <label>Ciudad:</label>
    <input type="text" name="city" value="{{ old('city') }}" required>
    <br><br>

    <label>Pais:</label>
    <input type="text" name="country" value="{{ old('country') }}" required>
    <br><br>

    <label>Continente:</label>
    <input type="text" name="continent" value="{{ old('continent') }}" required>
    <br><br>

    <label>Clima:</label>
    <input type="text" name="weather_type" value="{{ old('weather_type') }}" required>
    <br><br>

    <label>Descripcion:</label><br>
    <textarea name="description" required>{{ old('description') }}</textarea>
    <br><br>

    <label>URL Imagen:</label>
    <input type="text" name="image_url" value="{{ old('image_url') }}">
    <br><br>

    <label>Estado:</label>
    <select name="status" required>
        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Activo</option>
        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactivo</option>
    </select>
    <br><br>

    <button type="submit">Guardar Localizacion</button>
</form>

<br>
<a href="{{ route('locations.index') }}">Cancelar y volver</a>