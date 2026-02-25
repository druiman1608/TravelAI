<h1>Listado de Reservas</h1>
@if(auth()->user()->isAdmin())
<p><strong>Administrador:</strong> Viendo todas las ventas.</p>
@else
<p>Mis reservas:</p>
@endif

@include('reservations._list')

<br>
<a href="{{ route('dashboard') }}">Volver al Dashboard</a>