<link rel="stylesheet" href="{{ asset('css/_lists/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>Nombre del Paquete</th>
            <th>Hotel</th>
            <th>Vuelo (Origen)</th>
            <th>Actividad</th>
            <th>Precio Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($packages as $package)
        <tr>
            <td>{{ $package->name }}</td>

            <td>{{ $package->hotel->name ?? 'No incluido' }}</td>

            <td>
                @if($package->flight)
                {{ $package->flight->airline }} ({{ $package->flight->origin }})
                @else
                No incluido
                @endif
            </td>

            <td>{{ $package->activity->name ?? 'No incluida' }}</td>

            <td><strong>{{ $package->total_price }}€</strong></td>
            <td>
                <a href="{{ route('packages.show', $package->id) }}">Ver</a>

                @if(auth()->user()->isAdmin())
                | <a href="{{ route('packages.edit', $package->id) }}">Editar</a> |
                <form action="{{ route('packages.destroy', $package->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Borrar paquete?')">Borrar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($packages->isEmpty())
<p>No hay paquetes disponibles.</p>
@endif