@extends('layouts.app')

@section('content')
<b-container class="container mt-2">
    <b-row align-h="center">
        <b-col md="8" offset-md="2">
            
            <b-card title="Registro">
                
                @if ( $errors->any())
                    <b-alert show dismissible variant="danger">
                        <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </b-alert>    
                @endif

                <b-form method="POST" action="{{ route('register') }}">
                    @csrf
                    <b-form-group label="Nombre" label-for="name" >
                        <b-form-input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                        </b-form-input>
                    </b-form-group>

                    <b-form-group label="Correo electrónico:" label-for="email" description="Nunca compartiremos tu correo. Está seguro con nosotros.">
                        <b-form-input id="email" type="email" name="email" value="{{ old('email') }}" required 
                        placeholder="example@gmail.com">
                        </b-form-input>
                    </b-form-group>
            
                    <b-form-group label="Contraseña" label-for="password">
                        <b-form-input id="password" type="password" name="password" required></b-form-input>
                    </b-form-group>

                    <b-form-group label="Confirmar contraseña" label-for="password_confirmation">
                        <b-form-input id="password_confirmation" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required></b-form-input>
                    </b-form-group>
                    
                    <b-button type="submit" variant="primary">Confirmar registro</b-button>
                    <b-link href="{{ route('login') }}" class="card-link">¿Ya te has registrado?</b-link>
                
                </b-form>
            </b-card>
        </b-col>
    </b-row>
</b-container>
@endsection
