<form method="POST" action="{{ route('login') }}">
    @csrf

    <h1>Iniciar Sesion</h1>
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email')
    <span style="color: red;">{{$message}}</span>
    @enderror

    <label>Contraseña</label>
    <input type="password" name="password" required>
    @error('password')
    <span style="color: red;">{{$message}}</span>
    @enderror

    <button type="submit">Entrar</button>
</form>