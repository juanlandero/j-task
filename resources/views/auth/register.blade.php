@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-5">
            <form class="border border-light p-5" method="POST" action="{{ route('register') }}">
                @csrf
                <p class="h4 mb-4 text-center">Alumnos</p>

                <input type="text" id="name" name="name" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="off" autofocus placeholder="Nombre">
                <input type="text" id="first_name" name="first_name" class="form-control mb-2" placeholder="Primer apellido" required autocomplete="off">
                <input type="text" id="second_name" name="second_name" class="form-control mb-2" placeholder="Segundo apellido" required autocomplete="off">

                <input type="email" id="email" name="email" class="form-control mb-2 @error('email') is-invalid @enderror" placeholder="Correo" value="{{ old('email') }}" required autocomplete="email">
                <input type="password" id="password" name="password" class="form-control mb-2" placeholder="Contraseña"  required autocomplete="off">
                <input type="password" id="password-confirm" name="password_confirmation" class="form-control mb-2" placeholder="Confirmar contraseña" required autocomplete="off">

                <button class="btn btn-info my-4 btn-block" type="submit">Registrarme</button>
            </form>

        </div>
    </div>
</div>

{{--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}
@endsection
