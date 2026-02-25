<link rel="stylesheet" href="{{ asset('../../css/_list/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>Fecha</th>
            @if(auth()->user()->isAdmin())
            <th>Usuario</th>
            @endif
            <th>Pregunta (Resumen)</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
            @if(auth()->user()->isAdmin())
            <td>{{ $log->user->name }}</td>
            @endif

            <td>{{ Str::limit($log->user_question, 40) }}...</td>
            <td>
                <a href="{{ route('aichatlogs.show', $log->id) }}">Ver</a>
                @if(auth()->user()->isAdmin())
                |
                <form action="{{ route('aichatlogs.destroy', $log->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar log?')">Borrar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($logs->isEmpty())
<p>No se encontraron registros</p>
@endif