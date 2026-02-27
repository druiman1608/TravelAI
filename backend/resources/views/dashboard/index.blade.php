<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="dashboard-container">
    @include('partials.alerts')

    <h1>Dashboard</h1>
    <p>Bienvenido, <strong>{{ auth()->user()->name }}</strong>
        @if(auth()->user()->isPremium()) <span style="color: gold; font-weight: bold;"> [PREMIUM]</span> @endif
        @if(auth()->user()->isMod()) <span style="color: #0275d8; font-weight: bold;"> [MODERADOR]</span> @endif
        @if(auth()->user()->isAdmin()) <span style="color: #c53030; font-weight: bold;"> [ADMINISTRADOR]</span> @endif
    </p>

    <hr class="hr-divider">

    @if(auth()->user()->isAdmin())
    <div class="admin-panel"
        style="background-color: #fff5f5; padding: 20px; border-radius: 8px; border: 1px solid #feb2b2; margin-bottom: 20px;">
        <h4 style="color: #c53030; margin-top: 0;">Panel de Administracion</h4>
        <div class="nav-menu">
            <a href="{{ route('users.index') }}" class="btn btn-danger">Gestionar Usuarios</a>
            <a href="{{ route('locations.index') }}" class="btn btn-primary">Gestionar Localizaciones</a>
            <a href="{{ route('hotels.index') }}" class="btn btn-secondary">Gestionar Hoteles</a>
            <a href="{{ route('flights.index') }}" class="btn btn-secondary">Gestionar Vuelos</a>
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">Gestionar Actividades</a>
            <a href="{{ route('packages.index') }}" class="btn btn-secondary">Gestionar Paquetes</a>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Gestionar Reservas</a>
            <a href="{{ route('reviews.index') }}" class="btn btn-purple">Gestionar Reseñas</a>
            <a href="{{ route('aichatlogs.index') }}" class="btn btn-outline">Gestionar Logs IA</a>
        </div>
    </div>
    @endif

    @if(auth()->user()->isMod())
    <div class="mod-panel"
        style="background-color: #ebf8ff; padding: 20px; border-radius: 8px; border: 1px solid #bee3f8; margin-bottom: 20px;">
        <h4 style="color: #2b6cb0; margin-top: 0;">Panel de Moderación</h4>
        <div class="nav-menu">
            <a href="{{ route('reviews.index') }}" class="btn btn-primary">Gestionar todas las Reseñas</a>
            <p style="font-size: 0.9em; color: #4a5568; margin-top: 10px;">Tienes permisos para aprobar o rechazar
                comentarios de usuarios.</p>
        </div>
    </div>
    @endif

    @if(!auth()->user()->isAdmin())

    <h3>Explorar Catalogos</h3>
    <div class="catalog-menu">
        <a href="{{ route('hotels.index') }}" class="btn-catalog border-hotels">Ver Hoteles</a>
        <a href="{{ route('flights.index') }}" class="btn-catalog border-flights">Ver Vuelos</a>
        <a href="{{ route('packages.index') }}" class="btn-catalog border-packages">Ver Paquetes</a>
        <a href="{{ route('activities.index') }}" class="btn-catalog border-activities">Ver Actividades</a>
    </div>

    <h3>Mis Gestiones</h3>
    <div class="nav-menu">
        <a href="{{ route('reservations.index') }}" class="btn btn-primary">Mis Reservas</a>
        <a href="{{ route('reservations.create') }}" class="btn btn-success">Nueva Reserva</a>
        <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Reseñas</a>
        <a href="{{ route('reviews.create') }}" class="btn btn-purple">Crear Reseña</a>
        <a href="{{ route('userPreferences.index') }}" class="btn btn-outline">Mis Preferencias</a>

        @if(auth()->user()->isPremium())
        <a href="{{ route('aichatlogs.create') }}" class="btn btn-gold"
            style="background-color: #ffd700; color: black; font-weight: bold;">Preguntar a IA</a>
        <a href="{{ route('aichatlogs.index') }}" class="btn btn-outline">Historial IA</a>
        @endif
    </div>

    <hr class="hr-divider">

    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <div style="flex: 2; min-width: 300px;">
            <h3>Ofertas destacadas</h3>
            <div class="offers-grid">
                @forelse($data['packages'] as $package)
                <div class="card">
                    <span class="badge badge-success">Oferta</span>
                    <h4>{{ $package->name }}</h4>
                    <p class="card-price">{{ number_format($package->total_price, 2) }}€</p>
                    <a href="{{ route('packages.show', $package->id) }}">Ver detalles</a>
                </div>
                @empty
                <p>No hay paquetes disponibles.</p>
                @endforelse
            </div>
        </div>

        <div
            style="flex: 1; min-width: 250px; background: #f9fafb; padding: 15px; border-radius: 8px; border: 1px solid #edf2f7;">
            <h3>Lo que dicen otros...</h3>
            @forelse($data['latest_reviews'] as $review)
            <div style="border-bottom: 1px solid #e2e8f0; margin-bottom: 10px; padding-bottom: 8px;">
                <small><strong>{{ $review->user->name }}</strong> sobre
                    @if($review->hotel) {{ $review->hotel->name }} @else servicio @endif
                </small>
                <p style="font-style: italic; font-size: 0.85em; margin: 5px 0; color: #4a5568;">
                    "{{ Str::limit($review->comment, 50) }}"</p>
                <span style="color: #ecc94b;">{{ str_repeat('★', $review->rating) }}</span>
            </div>
            @empty
            <p style="font-size: 0.8em; color: #a0aec0;">Aún no hay reseñas.</p>
            @endforelse
            <a href="{{ route('reviews.index') }}" style="font-size: 0.8em; color: #3182ce; text-decoration: none;">Ver
                todas las opiniones →</a>
        </div>
    </div>

    <h3>Mis reservas</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estado</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data['reservations'] as $res)
            <tr>
                <td>#{{ $res->id }}</td>
                <td>
                    <span
                        class="badge {{ $res->status == 'confirmada' ? 'badge-success' : ($res->status == 'cancelada' ? 'badge-danger' : 'badge-warning') }}">
                        {{ ucfirst($res->status) }}
                    </span>
                </td>
                <td><strong>{{ number_format($res->price, 2) }}€</strong></td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No has realizado ninguna reserva.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @endif

    <br>
    <hr><br>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger" style="width: 100%; padding: 10px; cursor: pointer;">Cerrar
            Sesion</button>
    </form>
</div>