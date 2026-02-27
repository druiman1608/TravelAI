<table border="1">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Tipo de Viaje</th>
            <th>Presupuesto Maximo</th>
            <th>Clima Favorito</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($preferences as $pref)
        <tr>
            <td>{{ $pref->user->name }}</td>
            <td>{{ $pref->travel_type }}</td>
            <td>{{ number_format($pref->max_budget, 2) }}€</td>
            <td>{{ $pref->fav_weather }}</td>
            <td>
                <a href="{{ route('userPreferences.edit', $pref->id) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>