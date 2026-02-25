<h1>Añadir Nuevo Hotel</h1>

<form action="{{ route('hotels.store') }}" method="POST">
    @csrf

    <label>Nombre del Hotel:</label>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Ubicacion:</label>
    <select name="location_id">
        <option value="">Selecciona una ciudad</option>
        @foreach($locations as $location)
        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
            {{ $location->city }} ({{ $location->country }})
        </option>
        @endforeach
    </select>
    @error('location_id') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Estrellas:</label>
    <input type="number" name="stars" min="1" max="5" value="{{ old('stars') }}">
    @error('stars') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Precio por noche:</label>
    <input type="number" step="0.01" name="price_per_night" value="{{ old('price_per_night') }}">
    @error('price_per_night') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Descripcion:</label><br>
    <textarea name="description" rows="4">{{ old('description') }}</textarea>
    @error('description') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <button type="submit">Guardar Hotel</button>
</form>
<a href="{{ route('hotels.index') }}">Cancelar</a>