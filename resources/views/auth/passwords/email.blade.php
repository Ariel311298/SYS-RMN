@extends('layouts.app')

@section('title')
Formulario de Cambio de Contraseña
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Formulario de Cambio de Contraseña') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electronico *') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar Link') }}
                                    <i class="fas fa-envelope"></i>
                                </button>                             
                                <br>
                                <br>
                                <a href="/login">
                                    <button type="button" class="btn btn-danger center-block">
                                    Regresar
                                    <i class="fas fa-arrow-left"></i>
                                    </button>
                                </a>
                            </div>
                        </div>

                        <br>
                        <p><strong>Ingrese su dirección de correo electronico para cambiar la contraseña en caso de olvidar.</strong></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
