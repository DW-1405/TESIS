@extends('layout.layouts')

@section('content')

<form method="POST" action="{{ route('login') }}" class="form-login">
    @csrf
    <h3 class="title">{{__('Iniciar Sesión')}}</h3>
    <div class="control-group">
        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        <label for="name" id="user">{{ __('Usuario') }}</label>
        <div class="bar"></div>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <i id="pass-i" class="fas fa-exclamation-triangle"></i>
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>

    <div class="control-group">
        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <label for="password" id="pass">{{ __('Contraseña') }}</label>
        <div class="bar"></div>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <i id="pass-i" class="fas fa-exclamation-triangle"></i>
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>
    <button class="btn-login">{{ __('Login') }}</button>
    <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    <label class="form-check-label" for="remember">
        {{ __('Recordarme') }}
    </label>
    @if (Route::has('password.request'))
    {{-- <a class="forgor-password" href="{{ route('password.request') }}">--}}
    <a class="forgor-password">
        {{ __('¿Olvidaste tu contraseña?') }}
    </a>
    @endif
</form>
@endsection
