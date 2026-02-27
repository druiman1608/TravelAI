<h1>Editar Hotel: {{ $hotel->name }}</h1>

<form action="{{ route('hotels.update', $hotel->id) }}" method="POST">
    @csrf @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ old('name', $hotel->name) }}" required>
    <br><br>

    <label>Ubicacion:</label>
    <select name="location_id" required>
        @foreach($locations as $location)
        <option value="{{ $location->id }}"
            {{ old('location_id', $hotel->location_id) == $location->id ? 'selected' : '' }}>
            {{ $location->city }}
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Estrellas:</label>
    <input type="number" name="stars" min="1" max="5" value="{{ old('stars', $hotel->stars) }}" required>
    <br><br>

    <label>Precio por noche:</label>
    <input type="number" step="0.01" name="price_per_night"
        value="{{ old('price_per_night', $hotel->price_per_night) }}" required>
    <br><br>

    <label>Descripcion:</label><br>
    <textarea name="description" required>{{ old('description', $hotel->description) }}</textarea>
    <br><br>

    <button type="submit">Actualizar Hotel</button>
</form>

<br>
<a href="{{ route('hotels.index') }}">Cancelar y volver</a>