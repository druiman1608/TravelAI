<h1>Detalle de la consulta #{{ $aiChatLog->id }}</h1>

<p><strong>Fecha:</strong> {{ $aiChatLog->created_at->format('d/m/Y H:i:s') }}</p>
<p><strong>Usuario:</strong> {{ $aiChatLog->user->name }} ({{ $aiChatLog->user->email }})</p>

<hr>

<div style="margin-bottom: 20px;">
    <h3 style="color: blue;">Pregunta del Usuario:</h3>
    <div style="background: #f0f0f0; padding: 15px; border-radius: 5px;">
        {{ $aiChatLog->user_question }}
    </div>
</div>

<div>
    <h3 style="color: green;">Respuesta de la IA:</h3>
    <div style="background: #e8f5e9; padding: 15px; border-radius: 5px; white-space: pre-wrap;">
        {{ $aiChatLog->ai_answer }}
    </div>
</div>

<br>
<a href="{{ route('aichatlogs.index') }}">Volver al historial</a>