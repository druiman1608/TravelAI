<h1>Detalles del paquete: {{ $package->name }}</h1>

<div style="border: 1px solid #ccc; padding: 20px; border-radius: 8px;">
    <h3>Este paquete incluye:</h3>
    <ul>
        @if($package->hotel)
        <li><strong>Hotel:</strong> {{ $package->hotel->name }} ({{ $package->hotel->location->city }})</li>
        @endif

        @if($package->flight)
        <li><strong>Vuelo:</strong> {{ $package->flight->airline }} ({{ $package->flight->origin }} a
            {{ $package->flight->location->city }})
        </li>
        @endif

        @if($package->activity)
        <li><strong>Actividad:</strong> {{ $package->activity->name }} en {{ $package->activity->location->city }}</li>
        @endif
    </ul>

    <hr>
    <h2>Precio final: {{ $package->total_price }}€</h2>

    @if(!auth()->user()->isAdmin())
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="package_id" value="{{ $package->id }}">
        <button type="submit"
            style="background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Reservar
        </button>
    </form>
    @else
    <p><a href="{{ route('packages.edit', $package->id) }}">Modificar paquete</a></p>
    @endif
</div>

<br>
<a href="{{ route('packages.index') }}">Volver</a>