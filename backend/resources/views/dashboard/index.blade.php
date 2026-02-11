<h1>Dashboard:</h1>
<h2>Bienvenido, {{ auth()->user()->name }}</h2>

@if(auth()->user()->isAdmin())
<h3>Ultimos hoteles registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ubicacion</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['hotels'] as $hotel)
        <tr>
            <td>{{$hotel->name}}</td>
            <td>{{$hotel->location->city ?? 'Sin ubicacion'}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No se encontraron hoteles.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Ultimos vuelos registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Origen</th>
            <th>Destino</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['flights'] as $flight)
        <tr>
            <td>Ciudad: {{$flight->origin}}</td>
            <td>Ciudad: {{$flight->location->city}} | Pais: {{$flight->location->country}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No se encontraron vuelos.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Ultimos paquetes registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['packages'] as $package)
        <tr>
            <td>{{$package->name}}</td>
            <td>{{$package->total_price}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No se encontraron paquetes.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Ultimas actividades registradas</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['activities'] as $activity)
        <tr>
            <td>{{$activity->name}}</td>
            <td>{{$activity->description}}</td>
            <td>{{$activity->price}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">No se encontraron actividades.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Ultimos usuarios registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['users'] as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{ $user->role->name ?? 'ID: ' . $user->role_id }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">No hay usuarios registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@else

<h3>Hoteles:</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ubicacion</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['hotels'] as $hotel)
        <tr>
            <td>{{$hotel->name}}</td>
            <td>{{$hotel->location->city ?? 'Sin ubicacion'}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No hay hoteles disponibles.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Vuelos:</h3>
<table border="1">
    <thead>
        <tr>
            <th>Origen</th>
            <th>Destino</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['flights'] as $flight)
        <tr>
            <td>Ciudad: {{$flight->origin}}</td>
            <td>Ciudad: {{$flight->location->city}} | Pais: {{$flight->location->country}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No hay vuelos disponibles.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Paquetes:</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['packages'] as $package)
        <tr>
            <td>{{$package->name}}</td>
            <td>{{$package->total_price}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No hay paquetes disponibles.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Actividades:</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['activities'] as $activity)
        <tr>
            <td>{{$activity->name}}</td>
            <td>{{$activity->description}}</td>
            <td>{{$activity->price}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">No hay actividades disponibles.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Mis reservas</h3>
<table border="1">
    <thead>
        <tr>
            <th>Estado</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['reservations'] as $reservation)
        <tr>
            <td>{{$reservation->status}}</td>
            <td>{{$reservation->price}}€</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No tienes reservas.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Mis Chats</h3>
<table border="1">
    <thead>
        <tr>
            <th>Pregunta</th>
            <th>Respuesta</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['aichatlogs'] as $aichatlog)
        <tr>
            <td>{{$aichatlog->user_question}}</td>
            <td>{{$aichatlog->ai_answer}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No hay historial de chats.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif

<br>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar Sesion</button>
</form>