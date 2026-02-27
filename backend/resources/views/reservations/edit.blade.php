<h1>Editar Reserva #{{ $reservation->id }}</h1>

@include('partials.alerts')

<form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
    @csrf
    @method('PUT')

    @if(auth()->user()->isAdmin())
    <div>
        <label>Paquete:</label><br>
        <select name="package_id">
            <option value="">Ninguno</option>
            @foreach($packages as $package)
            <option value="{{ $package->id }}" {{ $reservation->package_id == $package->id ? 'selected' : '' }}>
                {{ $package->name }} ({{ $package->total_price }}€)
            </option>
            @endforeach
        </select>
    </div>
    <br>

    <div>
        <label>Hotel:</label><br>
        <select name="hotel_id">
            <option value="">Ninguno</option>
            @foreach($hotels as $hotel)
            <option value="{{ $hotel->id }}" {{ $reservation->hotel_id == $hotel->id ? 'selected' : '' }}>
                {{ $hotel->name }} ({{ $hotel->location->name }})
            </option>
            @endforeach
        </select>
    </div>
    <br>

    <div>
        <label>Vuelo:</label><br>
        <select name="flight_id">
            <option value="">Ninguno</option>
            @foreach($flights as $flight)
            <option value="{{ $flight->id }}" {{ $reservation->flight_id == $flight->id ? 'selected' : '' }}>
                {{ $flight->airline }} - {{ $flight->destination }}
            </option>
            @endforeach
        </select>
    </div>
    <br>

    <div>
        <label>Actividad:</label><br>
        <select name="activity_id">
            <option value="">Ninguno</option>
            @foreach($activities as $activity)
            <option value="{{ $activity->id }}" {{ $reservation->activity_id == $activity->id ? 'selected' : '' }}>
                {{ $activity->name }}
            </option>
            @endforeach
        </select>
    </div>
    <br>

    <label>Estado de la Reserva [Vista Admin]:</label><br>
    <select name="status">
        <option value="pendiente" {{ $reservation->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
        <option value="confirmada" {{ $reservation->status == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
        <option value="cancelada" {{ $reservation->status == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
    </select>
    <br><br>
    <button type="submit">Guardar Cambios</button>

    @else
    <div style="background: #f4f4f4; padding: 15px; border-radius: 8px;">
        <p><strong>Detalles de tu reserva:</strong></p>
        <ul>
            @if($reservation->package_id) <li>Paquete: {{ $reservation->package->name }}</li> @endif
            @if($reservation->hotel_id) <li>Hotel: {{ $reservation->hotel->name }}</li> @endif
            @if($reservation->flight_id) <li>Vuelo: {{ $reservation->flight->airline }}
                ({{ $reservation->flight->destination }})</li> @endif
            @if($reservation->activity_id) <li>Actividad: {{ $reservation->activity->name }}</li> @endif
        </ul>
        <p><strong>Precio Total:</strong> {{ number_format($reservation->price, 2) }}€</p>
        <p><strong>Estado actual:</strong> {{ ucfirst($reservation->status) }}</p>
    </div>

    <br>
    @if($reservation->status !== 'cancelada')
    <input type="hidden" name="status" value="cancelada">
    <button type="submit" style="background: red; color: white;"
        onclick="return confirm('¿Seguro de que quieres cancelar esta reserva?')">
        Cancelar Reserva
    </button>
    @else
    <p style="color: red;">Esta reserva ya ha sido cancelada.</p>
    @endif
    @endif
</form>

<br>
<a href="{{ route('reservations.index') }}">Cancelar y volver</a>