<h1>Gestionar Localizaciones:</h1>
@if(auth()->user()->isAdmin())
<p><a href="{{ route('locations.create') }}">Añadir nueva localizacion</a></p>
@endif
@include('locations._list')