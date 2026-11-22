@extends('layouts.app')

@section('content')
    <h1>Iniciar sesión en biblioteca</h1>

    @if ($errors->any())
        <ul role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <label for="username">Usuario</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" autocomplete="username" autofocus required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" autocomplete="current-password" required>

        <button type="submit">Iniciar sesión</button>
    </form>
@endsection
        
