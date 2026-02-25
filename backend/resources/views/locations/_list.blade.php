<link rel="stylesheet" href="{{ asset('../../css/_list/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>Ciudad</th>
            <th>Pais</th>
            <th>Continente</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($locations as $location)
        <tr>
            <td>{{ $location->city }}</td>
            <td>{{ $location->country }}</td>
            <td>{{ $location->continent }}</td>
            <td>
                {{ $location->status ? 'Activo' : 'Inactivo'}}
            </td>
            <td>
                <a href="{{ route('locations.show', $location->id) }}">Ver</a>
                @if(auth()->user()->isAdmin())
                | <a href="{{ route('locations.edit', $location->id) }}">Editar</a> |
                <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('¿Borrar ciudad? cuidado, esto borrara hoteles y vuelos asociados a esta localizacion.')">Borrar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if($locations->isEmpty()) <p>No hay localizaciones creadas.</p> @endif