<link rel="stylesheet" href="{{ asset('../../css/_list/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>Aerolinea</th>
            <th>Origen</th>
            <th>Ciudad de destino</th>
            <th>Salida</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($flights as $flight)
        <tr>
            <td>{{ $flight->airline }}</td>
            <td>{{ $flight->origin }}</td>
            <td>{{ $flight->location->city }}</td>
            <td>{{ ($flight->departure)->format('d/m/Y H:i') }}</td>
            <td>{{ $flight->price }}€</td>
            <td>
                <a href="{{ route('flights.show', $flight->id) }}">Ver</a>
                @if(auth()->user()->isAdmin())
                | <a href="{{ route('flights.edit', $flight->id) }}">Editar</a> |
                <form action="{{ route('flights.destroy', $flight->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Borrar vuelo?')">Borrar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if($flights->isEmpty())
<p>No hay vuelos disponibles.</p>
@endif