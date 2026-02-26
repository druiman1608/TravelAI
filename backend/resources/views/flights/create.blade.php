<h1>Añadir Nuevo Vuelo</h1>

<form action="{{ route('flights.store') }}" method="POST">
    @csrf
    <label>Aerolinea:</label>
    <input type="text" name="airline" value="{{ old('airline') }}" required>
    @error('airline') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Destino:</label>
    <select name="location_id" required>
        @foreach($locations as $location)
        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
            {{ $location->city }} ({{ $location->country }})
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Origen:</label>
    <input type="text" name="origin" value="{{ old('origin') }}" required>
    @error('origin') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Salida:</label>
    <input type="datetime-local" name="departure" value="{{ old('departure') }}" required>
    @error('departure') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Llegada:</label>
    <input type="datetime-local" name="arrival" value="{{ old('arrival') }}" required>
    @error('arrival') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Precio:</label>
    <input type="number" name="price" step="0.01" value="{{ old('price', $flight->price ?? '') }}" required>
    @error('price') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <button type="submit">Guardar Vuelo</button>
</form>