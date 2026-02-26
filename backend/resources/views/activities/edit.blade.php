<h1>Editar Actividad: {{ $activity->name }}</h1>

<form action="{{ route('activities.update', $activity->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ old('name', $activity->name) }}" required>
    @error('name') <div style="color:red">{{ $message }}</div> @enderror
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
    @error('location_id') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Descripcion:</label>
    <textarea name="description">{{ old('description', $activity->description) }}</textarea>
    @error('description') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $activity->price) }}" required>
    @error('price') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <button type="submit">Actualizar Actividad</button>
</form>
<a href="{{ route('activities.index') }}">Volver</a>