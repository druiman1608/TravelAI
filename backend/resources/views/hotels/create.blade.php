<h1>Añadir Nuevo Hotel</h1>Ç

@include('partials.alerts')

<form action="{{ route('hotels.store') }}" method="POST">
    @csrf

    <label>Nombre del Hotel:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <br><br>

    <label>Ubicacion:</label>
    <select name="location_id" required>
        <option value="">Selecciona una ciudad</option>
        @foreach($locations as $location)
        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
            {{ $location->city }} ({{ $location->country }})
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Estrellas:</label>
    <input type="number" name="stars" min="1" max="5" value="{{ old('stars') }}" required>
    <br><br>

    <label>Precio por noche:</label>
    <input type="number" step="0.01" name="price_per_night" value="{{ old('price_per_night') }}" required>
    <br><br>

    <label>Descripcion:</label><br>
    <textarea name="description" required rows="4">{{ old('description') }}</textarea>
    <br><br>

    <button type="submit">Guardar Hotel</button>
</form>

<br>
<a href="{{ route('hotels.index') }}">Cancelar y volver</a>