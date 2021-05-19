@extends('dashboard.master')

@include('dashboard.vistasParciales.navBar')
@section('contenido')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Logo</th>
            </tr>
        </thead>
        <tbody>
            {{--  @foreach ($marcas as $marca)
                <tr>
                    <th scope="row">{{ $marca->nombre}}</th>
                    
                </tr>
            @endforeach  --}}
        </tbody>
    </table>

@endsection
