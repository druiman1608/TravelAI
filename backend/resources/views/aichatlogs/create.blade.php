<h1>Consultar a la IA</h1>

@include('partials.alerts')

<form action="{{ route('aichatlogs.store') }}" method="POST">
    @csrf

    <label>Escribe tu pregunta:</label><br>
    <textarea name="user_question" required>{{ old('user_question') }}</textarea>
    <br><br>

    <button type="submit">Preguntar</button>
</form>

<br>
<a href="{{ route('aichatlogs.index') }}">Cancelar y volver</a>