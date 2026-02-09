<h1>Editar hotel:</h1>
<form method="POST" action="{{ route('hotels.update', $hotel->id) }}">
    @csrf
    @method('PUT')
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $hotel->name) }}" required><br><br>

    @error('name')
    <div class="error" style="color:red">{{ $message }}</div>
    @enderror

    <label for="description">Descripción:</label>
    <textarea id="description" name="description"
        required>{{ old('description', $hotel->description) }}</textarea><br><br>

    @error('description')
    <div class="error" style="color:red">{{ $message }}</div>
    @enderror

    <label for="stars">Estrellas:</label>
    <input type="number" id="stars" name="stars" min="1" max="5" value="{{ old('stars', $hotel->stars) }}"
        required><br><br>

    @error('stars')
    <div class="error" style="color:red">{{ $message }}</div>
    @enderror

    <label for="location_id">Ubicación:</label>
    <select id="location_id" name="location_id" required>
        <option value="">Selecciona una localizacion</option>
        @foreach($locations as $location)
        <option value="{{ $location->id }}"
            {{ old('location_id', $hotel->location_id) == $location->id ? 'selected' : '' }}>
            {{ $location->city }} ({{ $location->country }})
        </option>
        @endforeach
    </select>

    @error('location')
    <div class="error" style="color:red">{{ $message }}</div>
    @enderror

    <label for="price_per_night">Precio por noche:</label>
    <input type="number" id="price_per_night" name="price_per_night" step="0.01"
        value="{{ old('price_per_night', $hotel->price_per_night) }}" required><br><br>

    @error('price_per_night')
    <div class="error" style="color:red">{{ $message }}</div>
    @enderror

    <button type="submit">Actualizar hotel</button>
</form>