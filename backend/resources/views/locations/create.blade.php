<h1>Añadir Nueva Localizacion</h1>

<form action="{{ route('locations.store') }}" method="POST">
    @csrf

    <label>Ciudad:</label>
    <input type="text" name="city" value="{{ old('city') }}">
    @error('city') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Pais:</label>
    <input type="text" name="country" value="{{ old('country') }}">
    @error('country') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Continente:</label>
    <input type="text" name="continent" value="{{ old('continent') }}">
    @error('continent') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Clima:</label>
    <input type="text" name="weather_type" value="{{ old('weather_type') }}">
    @error('weather_type') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Descripcion:</label><br>
    <textarea name="description">{{ old('description') }}</textarea>
    @error('description') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>URL Imagen:</label>
    <input type="text" name="image_url" value="{{ old('image_url') }}">
    @error('image_url') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Estado:</label>
    <select name="status">
        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Activo</option>
        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactivo</option>
    </select>
    <br><br>

    <button type="submit">Guardar Localizacion</button>
</form>