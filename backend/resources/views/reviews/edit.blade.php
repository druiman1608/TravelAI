<h1>Editar Reseña</h1>

<form action="{{ route('reviews.update', $review->id) }}" method="POST">
    @csrf
    @method('PUT')

    @if(auth()->user()->isAdmin() || auth()->user()->isMod())
    <label>Estado:</label>
    <select name="status">
        <option value="pendiente" {{ $review->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
        <option value="publicada" {{ $review->status == 'publicada' ? 'selected' : '' }}>Publicada</option>
        <option value="borrada" {{ $review->status == 'borrada' ? 'selected' : '' }}>Borrada</option>
    </select>
    <br><br>
    @endif

    <label>Puntuacion:</label>
    <input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}">
    <br><br>

    <label>Comentario:</label><br>
    <textarea name="comment" rows="5" cols="40">{{ $review->comment }}</textarea>
    <br><br>

    <button type="submit">Guardar cambios</button>
</form>