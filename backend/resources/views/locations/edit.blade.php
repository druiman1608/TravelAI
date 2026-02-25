<h1>Editar Localizacion: {{ $location->city }}</h1>

<form action="{{ route('locations.update', $location->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="city">Ciudad:</label>
    <input type="text" id="city" name="city" value="{{ old('city', $location->city) }}" required>
    @error('city') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label for="country">Pais:</label>
    <input type="text" id="country" name="country" value="{{ old('country', $location->country) }}" required>
    @error('country') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label for="continent">Continente:</label>
    <input type="text" id="continent" name="continent" value="{{ old('continent', $location->continent) }}" required>
    @error('continent') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label for="weather_type">Clima:</label>
    <input type="text" id="weather_type" name="weather_type" value="{{ old('weather_type', $location->weather_type) }}"
        required>
    @error('weather_type') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label for="image_url">URL de la Imagen (Opcional):</label>
    <input type="text" id="image_url" name="image_url" value="{{ old('image_url', $location->image_url) }}">
    @error('image_url') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label for="status">Estado:</label>
    <select id="status" name="status" required>
        <option value="1" {{ old('status', $location->status) == 1 ? 'selected' : '' }}>Activo</option>
        <option value="0" {{ old('status', $location->status) == 0 ? 'selected' : '' }}>Inactivo</option>
    </select>
    @error('status') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label for="description">Descripcion:</label><br>
    <textarea id="description" name="description" rows="5" cols="50"
        required>{{ old('description', $location->description) }}</textarea>
    @error('description') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <button type="submit">Actualizar Localizacion</button>
</form>

<br>
<a href="{{ route('locations.index') }}">Cancelar y volver</a>