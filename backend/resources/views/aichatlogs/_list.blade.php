<link rel="stylesheet" href="{{ asset('css/_lists/_list.blade.css') }}">

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pregunta</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($logs as $log)
        <tr>
            <td>{{ $log->id }}</td>
            <td>{{ Str::limit($log->user_question, 50) }}</td>
            <td>{{ $log->user?->name ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('aichatlogs.show', $log->id) }}">Ver</a>
                @if(auth()->user()->isAdmin())
                |
                <form action="{{ route('aichatlogs.destroy', $log->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Borrar Log?')">Borrar</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No se encontraron logs en la base de datos.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($logs->isEmpty())
<p>No se encontraron registros</p>
@endif