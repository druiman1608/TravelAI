<h1>Editar Reserva #{{ $reservation->id }}</h1>

@if ($errors->any())
<div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 20px;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label><strong>Estado de la Reserva:</strong></label>
    <select name="status">
        <option value="pendiente" {{ old('status', $reservation->status) == 'pendiente' ? 'selected' : '' }}>Pendiente
        </option>
        <option value="confirmada" {{ old('status', $reservation->status) == 'confirmada' ? 'selected' : '' }}>
            Confirmada</option>
        <option value="cancelada" {{ old('status', $reservation->status) == 'cancelada' ? 'selected' : '' }}>Cancelada
        </option>
    </select>
    <br><br>

    <p><small>* El precio se recalcula al cambiar el servicio.</small></p>

    <label>Cambiar a Paquete:</label>
    <select name="package_id">
        <option value="">-- Ninguno --</option>
        @foreach($packages as $package)
        <option value="{{ $package->id }}"
            {{ old('package_id', $reservation->package_id) == $package->id ? 'selected' : '' }}>
            {{ $package->name }} ({{ $package->total_price }}€)
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Cambiar a Hotel:</label>
    <select name="hotel_id">
        <option value="">-- Ninguno --</option>
        @foreach($hotels as $hotel)
        <option value="{{ $hotel->id }}" {{ old('hotel_id', $reservation->hotel_id) == $hotel->id ? 'selected' : '' }}>
            {{ $hotel->name }} ({{ $hotel->price_per_night }}€/noche)
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Cambiar a Vuelo:</label>
    <select name="flight_id">
        <option value="">-- Ninguno --</option>
        @foreach($flights as $flight)
        <option value="{{ $flight->id }}"
            {{ old('flight_id', $reservation->flight_id) == $flight->id ? 'selected' : '' }}>
            {{ $flight->airline }} ({{ $flight->price }}€)
        </option>
        @endforeach
    </select>
    <br><br>

    <div style="background-color: #f4f4f4; padding: 10px; display: inline-block; border: 1px solid #ddd;">
        <strong>Precio actual:</strong> {{ $reservation->price }}€
    </div>
    <br><br>

    <button type="submit">Actualizar Reserva</button>
</form>

<br>
<a href="{{ route('reservations.index') }}">Cancelar y volver</a>