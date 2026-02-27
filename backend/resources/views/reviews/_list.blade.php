@include('partials.alerts')

<link rel="stylesheet" href="{{ asset('css/_lists/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>Rating 1-5</th>
            <th>Servicio</th>
            <th>Comentario</th>
            <th>Estado</th>
            <th>Autor</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reviews as $review)
        <tr class="{{ $review->status }}">
            <td>{{ $review->rating }} / 5</td>
            <td>
                @if($review->package) Paquete: {{ $review->package->name }}
                @elseif($review->hotel) Hotel: {{ $review->hotel->name }}
                @elseif($review->flight) Vuelo: {{ $review->flight->airline }}
                @endif
            </td>
            <td>{{ $review->comment }}</td>
            <td>
                {{ $review->status }}
                @if($review->status == 'pendiente' && $review->user_id == auth()->id())
                [Solo visible para ti]
                @endif
            </td>
            <td>{{ $review->user->name }}</td>
            <td>
                <a href="{{ route('reviews.show', $review->id) }}">Ver</a>

                @if(auth()->id() == $review->user_id || auth()->user()->isAdmin() || auth()->user()->isMod())
                | <a href="{{ route('reviews.edit', $review->id) }}">Editar</a>
                @endif

                @if(auth()->user()->isAdmin())
                | <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Borrar definitivamente?')">Eliminar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($reviews->isEmpty())
<p>No hay reseñas que mostrar.</p>
@endif