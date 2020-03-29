@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row align-items-center justify-content-center">
        <div class="col-md-5">
            <form class="border border-light p-5" method="POST" action="{{ route('password.email') }}">
                @csrf
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p class="h4 mb-4 text-center">Reset password</p>
            
                <input type="email" id="email" class="form-control mb-4" placeholder="Dirección de correo" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
            
                <button class="btn btn-info btn-block my-4" type="submit">Enviar link</button>
            
            </form>

        </div>
    </div>
</div>
@endsection
