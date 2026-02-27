<link rel="stylesheet" href="{{ asset('css/_lists/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            @if(auth()->user()->isAdmin()) <th>Usuario</th> @endif
            <th>Reserva de </th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $res)
        <tr>
            <td>#{{ $res->id }}</td>
            @if(auth()->user()->isAdmin()) <td>{{ $res->user->name }}</td> @endif
            <td>
                @if($res->package_id) Paquete: {{ $res->package->name }}
                @elseif($res->hotel_id) Hotel: {{ $res->hotel->name }}
                @elseif($res->flight_id) Vuelo: {{ $res->flight->airline }}
                @else Servicio eliminado @endif
            </td>
            <td>{{ $res->price }}€</td>
            <td>
                <strong>{{ $res->status }}</strong>
            </td>
            <td>
                <a href="{{ route('reservations.show', $res->id) }}">Ver</a>
                | <a href="{{ route('reservations.edit', $res->id) }}">Editar</a> |
                @if(auth()->user()->isAdmin())
                <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Cancelar reserva?')">Borrar</button>
                </form>

                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if($reservations->isEmpty()) <p>No hay reservas registradas.</p> @endif