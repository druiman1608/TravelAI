<h1>Listado de Reservas</h1>
@if(auth()->user()->isAdmin())
<p><strong>Administrador:</strong> Viendo todas las reservas del sistema.</p>
@else
<p>Mis reservas:</p>
@endif
<p><a href="{{ route('dashboard') }}">Volver al Dashboard</a></p>
<hr>
<br>
@include('reservations._list')