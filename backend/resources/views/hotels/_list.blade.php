<link rel="stylesheet" href="{{ asset('../../css/_list/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Estrellas</th>
            <th>Ubicacion</th>
            <th>Precio por noche</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hotels as $hotel)
        <tr>
            <td>{{ $hotel->name }}</td>
            <td>{{ $hotel->stars }}</td>
            <td>{{ $hotel->location->city ?? 'Sin ubicacion' }}</td>
            <td>{{ $hotel->price_per_night }}€</td>
            <td>
                <a href="{{ route('hotels.show', $hotel->id) }}">Ver</a>
                @if(auth()->user()->isAdmin())
                | <a href="{{ route('hotels.edit', $hotel->id) }}">Editar</a> |
                <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Borrar hotel?')">Borrar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if($hotels->isEmpty()) <p>No hay hoteles registrados.</p> @endif