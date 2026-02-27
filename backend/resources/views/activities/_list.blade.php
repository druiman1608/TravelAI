<link rel="stylesheet" href="{{ asset('css/_lists/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($activities as $activity)
        <tr>
            <td>{{ $activity->name }}</td>
            <td>{{ $activity->location->city ?? 'Sin localizacion' }}</td>
            <td>{{ $activity->price }}€</td>
            <td>
                <a href="{{ route('activities.show', $activity->id) }}">Ver</a>

                @if(auth()->user()->isAdmin())
                | <a href="{{ route('activities.edit', $activity->id) }}">Editar</a> |
                <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Seguro?')">Borrar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($activities->isEmpty())
<p>No hay actividades disponibles.</p>
@endif