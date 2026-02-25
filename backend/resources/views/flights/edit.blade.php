<h1>Editar Vuelo: {{ $flight->airline }}</h1>

<form action="{{ route('flights.update', $flight->id) }}" method="POST">
    @csrf @method('PUT')

    <label>Aerolinea:</label>
    <input type="text" name="airline" value="{{ old('airline', $flight->airline) }}">
    <br><br>

    <label>Destino:</label>
    <select name="location_id">
        @foreach($locations as $location)
        <option value="{{ $location->id }}"
            {{ old('location_id', $flight->location_id) == $location->id ? 'selected' : '' }}>
            {{ $location->city }}
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Salida:</label>
    <input type="datetime-local" name="departure"
        value="{{ old('departure', \Carbon\Carbon::parse($flight->departure)->format('Y-m-d\TH:i')) }}">
    <br><br>

    <button type="submit">Actualizar Vuelo</button>
</form>