<h1>Crear Nueva Reserva</h1>

<form action="{{ route('reservations.store') }}" method="POST">
    @csrf

    <label>Reservar Paquete:</label>
    <select name="package_id">
        <option value="">-- No seleccionar paquete --</option>
        @foreach($packages as $package)
        <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
            {{ $package->name }} ({{ $package->total_price }}€)
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Reservar Hotel:</label>
    <select name="hotel_id">
        <option value="">-- No seleccionar hotel --</option>
        @foreach($hotels as $hotel)
        <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
            {{ $hotel->name }} ({{ $hotel->price_per_night }}€/noche)
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Reservar Vuelo:</label>
    <select name="flight_id">
        <option value="">-- No seleccionar vuelo --</option>
        @foreach($flights as $flight)
        <option value="{{ $flight->id }}" {{ old('flight_id') == $flight->id ? 'selected' : '' }}>
            {{ $flight->airline }} - {{ $flight->origin }} ({{ $flight->price }}€)
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Reservar Actividad:</label>
    <select name="activity_id">
        <option value="">-- No seleccionar actividad --</option>
        @foreach($activities as $activity)
        <option value="{{ $activity->id }}" {{ old('activity_id') == $activity->id ? 'selected' : '' }}>
            {{ $activity->name }} ({{ $activity->price }}€)
        </option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Confirmar Reserva</button>
</form>

<br>
<a href="{{ route('reservations.index') }}">Cancelar y volver</a>