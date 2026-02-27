<h1>Mis Preferencias de Viaje</h1>

@include('partials.alerts')

@if(session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('userPreferences.store') }}" method="POST">
    @csrf

    <label>¿Tipo de viaje preferido? (Mochileo, Lujo, Relax, Aventura...)</label><br>
    <input type="text" name="travel_type" value="{{ old('travel_type', $preference->travel_type ?? '') }}" required>
    <br><br>

    <label>Presupuesto maximo aproximado:</label><br>
    <input type="number" step="0.01" name="max_budget" value="{{ old('max_budget', $preference->max_budget ?? '') }}"
        required>
    <br><br>

    <label>Clima favorito:</label><br>
    <input type="text" name="fav_weather" value="{{ old('fav_weather', $preference->fav_weather ?? '') }}" required>
    <br><br>

    <button type="submit">Guardar mis preferencias</button>

    <br>
    <br>
    <a href="{{ route('dashboard') }}">
        Cancelar y volver al Dashboard
    </a>
    <hr>
</form>