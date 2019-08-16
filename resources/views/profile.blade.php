@extends('layouts.app')

@section('content')

    {{-- cuando no colocas dos punto a las propiedades, es 
    para que este valor se suma en el interior de esta cadena --}}
    <profile-component 
        :user="{{ auth()->user() }}" 
        csrf-token="{{ csrf_token() }}" 
    />
@endsection

