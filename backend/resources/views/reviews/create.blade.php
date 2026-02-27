<h1>Dejar una Reseña</h1>

@if ($errors->any())
<div style="color: red;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('reviews.store') }}" method="POST">
    @csrf

    <p>Selecciona uno de los servicios para valorar:</p>

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

    <label>Actividad:</label>
    <select name="activity_id">
        <option value="">-- Ninguno --</option>
        @foreach($activities as $a)
        <option value="{{ $a->id }}">{{ $a->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Puntuación 1-5:</label>
    <input type="number" name="rating" min="1" max="5" value="5" required>
    <br><br>

    <label>Comentario:</label><br>
    <textarea name="comment" rows="5" cols="40" required></textarea>
    <br><br>

    <button type="submit">Publicar Reseña</button>
</form>

<br>
<a href="{{ route('reviews.index') }}">Cancelar y volver</a>