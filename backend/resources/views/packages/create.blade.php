<h1>Crear Nuevo Paquete</h1>

@include('partials.alerts')

<form action="{{ route('packages.store') }}" method="POST">
    @csrf

    <label>Nombre del Paquete:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <br><br>

    <p><small>* Selecciona al menos dos:</small></p>

    <label>Hotel:</label>
    <select name="hotel_id">
        <option value="">-- No incluir hotel --</option>
        @foreach($hotels as $hotel)
        <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
            {{ $hotel->name }} ({{ $hotel->location->city }})
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Vuelo:</label>
    <select name="flight_id">
        <option value="">-- No incluir vuelo --</option>
        @foreach($flights as $flight)
        <option value="{{ $flight->id }}" {{ old('flight_id') == $flight->id ? 'selected' : '' }}>
            {{ $flight->airline }}: {{ $flight->origin }} -> {{ $flight->location->city }}
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Actividad:</label>
    <select name="activity_id">
        <option value="">-- No incluir actividad --</option>
        @foreach($activities as $activity)
        <option value="{{ $activity->id }}" {{ old('activity_id') == $activity->id ? 'selected' : '' }}>
            {{ $activity->name }} ({{ $activity->location->city }})
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Precio Total:</label>
    <input type="number" step="0.01" name="total_price" value="{{ old('total_price') }}" required>
    <br><br>

    <button type="submit">Crear Paquete</button>
</form>

<br>
<a href="{{ route('packages.index') }}">Cancelar y volver</a>