<h1>Editar Actividad: {{ $activity->name }}</h1>

@include('partials.alerts')

<form action="{{ route('activities.update', $activity->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ old('name', $activity->name) }}" required>
    <br><br>

    <label>Ubicacion:</label>
    <select name="location_id" required>
        @foreach($locations as $location)
        <option value="{{ $location->id }}"
            {{ old('location_id', $activity->location_id) == $location->id ? 'selected' : '' }}>
            {{ $location->city }}, {{ $location->country }}
        </option>
        @endforeach
    </select>
    <br><br>

    <label>Descripcion:</label>
    <textarea name="description" required>{{ old('description', $activity->description) }}</textarea>
    <br><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $activity->price) }}" required>
    <br><br>

    <button type="submit">Actualizar Actividad</button>
</form>

<br>
<a href="{{ route('activities.index') }}">Cancelar y volver</a>