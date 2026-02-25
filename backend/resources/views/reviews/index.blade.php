<h1>Listado de Reseñas</h1>

@if(auth()->user()->isAdmin() || auth()->user()->isMod())
<p><strong>Moderador:</strong> Tienes permisos para moderar los comentarios de los usuarios.</p>
@else
<p>Tus opiniones sobre nuestros servicios:</p>
@endif

<p><a href="{{ route('reviews.create') }}">Escribir una nueva reseña</a></p>

@include('reviews._list')

<br>
<a href="{{ route('dashboard') }}">Volver al Dashboard</a>