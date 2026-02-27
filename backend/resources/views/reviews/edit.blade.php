<h1>Editar Reseña</h1>

<form action="{{ route('reviews.update', $review->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Reseña sobre:</label><br>
        <strong>
            @if($review->hotel_id) Hotel: {{ $review->hotel->name }}
            @elseif($review->flight_id) Vuelo: {{ $review->flight->airline }}
            @elseif($review->activity_id) Actividad: {{ $review->activity->name }}
            @elseif($review->package_id) Paquete: {{ $review->package->name }}
            @else Elemento no encontrado
            @endif
        </strong>
    </div>
    <br>

    <div>
        <label>Comentario:</label><br>
        <textarea name="comment" rows="5" cols="40" {{ auth()->user()->isMod() ? 'readonly' : '' }}
            {{ (auth()->user()->isAdmin() || !auth()->user()->isMod()) ? '' : 'readonly' }}>{{ $review->comment }}</textarea>
    </div>
    <br>

    @if(auth()->user()->isAdmin() || auth()->user()->isMod())
    <div>
        <label>Estado de la Reseña [Moderación]:</label><br>
        <select name="status">
            <option value="pendiente" {{ $review->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="aprobada" {{ $review->status == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
            <option value="rechazada" {{ $review->status == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
        </select>
    </div>
    <br>
    <button type="submit">Guardar Cambios</button>
    @else
    <p>Estado actual: <strong>{{ ucfirst($review->status) }}</strong></p>

    @if($review->status !== 'cancelada')
    <input type="hidden" name="status" value="cancelada">
    <button type="submit" onclick="return confirm('¿Seguro que quieres cancelar esta reseña?')">Eliminar Reseña</button>
    @endif
    @endif
</form>

<br>
<a href="{{ route('reviews.index') }}">Cancelar y volver</a>