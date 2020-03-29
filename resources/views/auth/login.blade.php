@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row align-items-center justify-content-center">
        <div class="col-md-5">
            <form class="border border-light p-5" method="POST" action="{{ route('login') }}">
                @csrf
                <p class="h4 mb-5 text-center">Sign in</p>

                <input type="email" id="email" class="form-control mb-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input type="password" id="password" class="form-control mb-4 @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="d-flex justify-content-between">
                    <div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Recuerdame</label>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
                    </div>
                </div>

                <button class="btn btn-info btn-block my-5" type="submit">Sign in</button>

                <div class="text-center">
                    <p>No estas registrado?
                        <a href="{{ route('register') }}">Registrate</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
