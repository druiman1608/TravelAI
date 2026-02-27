<h1>Editar Vuelo: {{ $flight->airline }}</h1>

@include('partials.alerts')

<form action="{{ route('flights.update', $flight->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Aerolinea:</label>
    <input type="text" name="airline" value="{{ old('airline', $flight->airline) }}" required>
    <br><br>

    <label>Destino:</label>
    <select name="location_id" required>
        @foreach($locations as $location)
        <option value="{{ $location->id }}"
            {{ old('location_id', $flight->location_id) == $location->id ? 'selected' : '' }}>
            {{ $location->city }} ({{ $location->country }})
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Origen:</label>
    <input type="text" name="origin" value="{{ old('origin', $flight->origin) }}" required>
    <br><br>

    <label>Salida:</label>
    <input type="datetime-local" name="departure"
        value="{{ old('departure', $flight->departure->format('Y-m-d\TH:i')) }}" required>
    <br><br>

    <label>Llegada:</label>
    <input type="datetime-local" name="arrival" value="{{ old('arrival', $flight->arrival->format('Y-m-d\TH:i')) }}"
        required>
    <br><br>

    <label>Precio:</label>
    <input type="number" name="price" step="0.01" value="{{ old('price', $flight->price) }}" required>
    <br><br>

    <button type="submit">Actualizar Vuelo</button>
</form>

<br>
<a href="{{ route('flights.index') }}">Cancelar y volver</a>