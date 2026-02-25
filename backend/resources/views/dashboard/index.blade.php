<h1>Dashboard</h1>
<p>Bienvenido, {{ auth()->user()->name }}</p>

<hr>

<h3>Navegacion</h3>
<ul>
    <li><a href="{{ route('reservations.index') }}">Mis Reservas</a></li>
    <li>
        <a href="{{ route('reviews.index') }}">
            Reseñas @if(auth()->user()->isMod()) (Moderacion) @endif
        </a>
    </li>

    @if(auth()->user()->isAdmin())
    <br>
    <li><strong>Administracion Global:</strong></li>
    <li><a href="{{ route('hotels.index') }}">Gestionar Hoteles</a></li>
    <li><a href="{{ route('flights.index') }}">Gestionar Vuelos</a></li>
    <li><a href="{{ route('packages.index') }}">Gestionar Paquetes</a></li>
    <li><a href="{{ route('activities.index') }}">Gestionar Actividades</a></li>
    <li><a href="{{ route('users.index') }}">Gestionar Usuarios</a></li>
    @endif
</ul>

<hr>

@if(auth()->user()->isAdmin())
<h3>Ultimos Usuarios Registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['users'] as $u)
        <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No hay usuarios nuevos.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif

<h3>Ofertas</h3>
<table border="1">
    <thead>
        <tr>
            <th>Servicio</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['packages'] as $p)
        <tr>
            <td>Paquete: {{ $p->name }}</td>
            <td>{{ $p->total_price }}€</td>
        </tr>
        @endforeach
        @foreach($data['hotels'] as $h)
        <tr>
            <td>Hotel: {{ $h->name }}</td>
            <td>{{ $h->location->city ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Resumen Reservas</h3>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['reservations'] as $res)
        <tr>
            <td>#{{ $res->id }}</td>
            <td>{{ $res->status }}</td>
            <td>{{ $res->price }}€</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">No tienes reservas registradas.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<br>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar Sesion</button>
</form>