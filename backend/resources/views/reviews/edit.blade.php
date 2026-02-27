<h1>Editar Reseña</h1>

@include('partials.alerts')

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
        <label>Puntuación (1-5):</label><br>
        <input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}"
            {{ auth()->user()->isMod() ? 'readonly' : '' }} required>
    </div>
    <br>

    <div>
        <label>Comentario:</label><br>
        <textarea name="comment" rows="5" cols="40" {{ auth()->user()->isMod() ? 'readonly' : '' }}
            required>{{ $review->comment }}</textarea>
    </div>
    <br>

    @if(auth()->user()->isAdmin() || auth()->user()->isMod())
    <div>
        <label>Estado de la Reseña [Moderacion]:</label><br>
        <select name="status">
            <option value="pendiente" {{ $review->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="publicada" {{ $review->status == 'publicada' ? 'selected' : '' }}>Publicada [Aprobada]
            </option>
            <option value="borrada" {{ $review->status == 'borrada' ? 'selected' : '' }}>Borrada [Rechazada]</option>
        </select>
    </div>
    <br>
    <button type="submit"
        style="background-color: #2b6cb0; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;">
        Guardar Cambios de Moderacion
    </button>
    @else
    <p>Estado actual: <strong>{{ ucfirst($review->status) }}</strong></p>

    @if($review->status !== 'borrada')
    <input type="hidden" name="status" value="{{ $review->status }}">
    <button type="submit"
        style="background-color: #38a169; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;">
        Actualizar mi comentario
    </button>
    <hr>
    <button type="submit" name="status" value="borrada"
        style="background-color: #e53e3e; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;"
        onclick="return confirm('¿Seguro que quieres eliminar esta reseña?')">
        Eliminar Reseña
    </button>
    @endif
    @endif
</form>

<br>
<a href="{{ route('reviews.index') }}" style="text-decoration: none; color: #4a5568;">← Cancelar y volver</a>