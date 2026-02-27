@if ($errors->any())
<div
    style="background-color: #fff5f5; color: #c53030; padding: 15px; border: 1px solid #feb2b2; border-radius: 8px; margin-bottom: 20px; font-family: sans-serif;">
    <strong style="display: block; margin-bottom: 5px;">Errores encontrados:</strong>
    <ul style="margin: 0; padding-left: 20px;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div
    style="background-color: #f0fff4; color: #2f855a; padding: 15px; border: 1px solid #c6f6d5; border-radius: 8px; margin-bottom: 20px; font-family: sans-serif;">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div
    style="background-color: #fff5f5; color: #c53030; padding: 15px; border: 1px solid #feb2b2; border-radius: 8px; margin-bottom: 20px; font-family: sans-serif;">
    {{ session('error') }}
</div>
@endif