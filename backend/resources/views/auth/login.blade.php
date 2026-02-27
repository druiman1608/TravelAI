<h1>Login</h1>

@include('partials.alerts')

<form method="POST" action="{{ route('login') }}">
    @csrf

    <h1>Iniciar Sesion</h1>
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <span style="color: red;">{{$message}}</span>

    <label>Contraseña</label>
    <input type="password" name="password" required>
    <span style="color: red;">{{$message}}</span>

    <button type="submit">Entrar</button>
</form>