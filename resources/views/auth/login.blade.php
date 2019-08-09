@extends('layouts.app')

@section('content')
<b-container class="container">
    <b-row align-h="center">
        <b-col cols="8">
            <b-card title="Inicio de sesión">
                
                {{-- <b-alert show>Por favor ingresa tus datos</b-alert> --}}
                
                <b-form method="POST" action="{{ route('login') }}">
                    @csrf
                    <b-form-group
                        label="Correo electrónico:" label-for="email" description="Nunca compartiremos tu correo. Está seguro con nosotros."
                    >
                        <b-form-input
                        id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="example@gmail.com"
                        ></b-form-input>
                    </b-form-group>


                    <b-form-group
                        label="Contraseña" label-for="password"
                    >
                        <b-form-input 
                        id="password" type="password" name="password" value="{{ old('password') }}" required
                        ></b-form-input>
                    </b-form-group>


                    <b-form-group>
                        <b-form-checkbox
                            name="remember" {{ old('remember') ? 'checked="true"' : '' }}
                        >
                            Recordar sesión
                        </b-form-checkbox>
                    </b-form-group>

                    <b-button type="submit" variant="primary">Ingresar</b-button>

                    <b-link href="{{ route('password.request') }}" class="card-link">¿Olvidaste tu constraseña?</b-link>
    
                </b-form>
            </b-card>
        </b-col>
    </b-row>
</b-container>
@endsection
