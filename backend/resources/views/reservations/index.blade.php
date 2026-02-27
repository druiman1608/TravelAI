<h1>Listado de Reservas</h1>
@if(auth()->user()->isAdmin())
<p><strong>Administrador:</strong> Viendo todas las reservas del sistema.</p>
@else
<p>Mis reservas:</p>
@endif
<p><a href="{{ route('dashboard') }}">Volver al Dashboard</a></p>
<p><a href="{{ route('reservations.create') }}">Crear nueva reserva</a></p>
<hr>
<br>
@include('reservations._list')