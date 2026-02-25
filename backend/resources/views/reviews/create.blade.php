<h1>Redactar una Reseña</h1>

<form action="{{ route('reviews.store') }}" method="POST">
    @csrf

    <p>Selecciona el servicio que deseas valorar:</p>

    <label>Paquete:</label>
    <select name="package_id">
        <option value="">-- Ninguno --</option>
        @foreach($packages as $p)
        <option value="{{ $p->id }}">{{ $p->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Hotel:</label>
    <select name="hotel_id">
        <option value="">-- Ninguno --</option>
        @foreach($hotels as $h)
        <option value="{{ $h->id }}">{{ $h->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Vuelo:</label>
    <select name="flight_id">
        <option value="">-- Ninguno --</option>
        @foreach($flights as $f)
        <option value="{{ $f->id }}">{{ $f->airline }} ({{ $f->origin }})</option>
        @endforeach
    </select>
    <br><br>

    <label>Puntuacion 1-5:</label>
    <input type="number" name="rating" min="1" max="5" value="5">
    <br><br>

    <label>Comentario:</label><br>
    <textarea name="comment" rows="5" cols="40"></textarea>
    <br><br>

    <button type="submit">Publicar Reseña</button>
</form>
<br>
<a href="{{ route('reviews.index') }}">Volver</a>