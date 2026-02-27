<h1>Reseña #{{ $review->id }}</h1>

<p><strong>Autor:</strong> {{ $review->user->name }}</p>
<p><strong>Servicio:</strong>
    @if($review->package) {{ $review->package->name }} Paquete
    @elseif($review->hotel) {{ $review->hotel->name }} Hotel
    @elseif($review->flight) {{ $review->flight->airline }} Vuelo
    @endif
</p>
<p><strong>Puntuacion:</strong> {{ $review->rating }} de 5</p>
<p><strong>Comentario:</strong> {{ $review->comment }}</p>
<p><strong>Estado:</strong> {{ $review->status }}</p>

<br>
<a href="{{ route('reviews.index') }}">Volver</a>