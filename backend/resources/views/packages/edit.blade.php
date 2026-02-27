<h1>Editar Paquete: {{ $package->name }}</h1>

@include('partials.alerts')

<form action="{{ route('packages.update', $package->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre del Paquete:</label>
    <input type="text" name="name" value="{{ old('name', $package->name) }}" required>
    <br><br>

    <label>Hotel:</label>
    <select name="hotel_id">
        <option value="">-- Quitar Hotel --</option>
        @foreach($hotels as $hotel)
        <option value="{{ $hotel->id }}" {{ old('hotel_id', $package->hotel_id) == $hotel->id ? 'selected' : '' }}>
            {{ $hotel->name }}
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Vuelo:</label>
    <select name="flight_id">
        <option value="">-- Quitar Vuelo --</option>
        @foreach($flights as $flight)
        <option value="{{ $flight->id }}" {{ old('flight_id', $package->flight_id) == $flight->id ? 'selected' : '' }}>
            {{ $flight->airline }} ({{ $flight->origin }} -> {{ $flight->location->city }})
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Actividad:</label>
    <select name="activity_id">
        <option value="">-- Quitar Actividad --</option>
        @foreach($activities as $activity)
        <option value="{{ $activity->id }}"
            {{ old('activity_id', $package->activity_id) == $activity->id ? 'selected' : '' }}>
            {{ $activity->name }}
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Precio Total:</label>
    <input type="number" step="0.01" name="total_price" value="{{ old('total_price', $package->total_price) }}"
        required>
    <br><br>

    <button type="submit">Guardar Cambios</button>
</form>

<br>
<a href="{{ route('packages.index') }}">Cancelar y volver</a>