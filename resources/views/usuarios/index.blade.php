@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <a href="{{ url('/usuarios/create') }}"><i class="fa fa-btn fa-plus"></i>Agregar usuario</a>
            <div class="col-md-10 col-md-offset-1">
            <table class="table">
                <thead>
                <th>
                    Nombre
                </th>
                <th>
                    Correo electrónico
                </th>
                <th>
                    Departamento
                </th>
                </thead>
                @foreach($usuarios as $usuario)
                    <tbody>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->condominio->departamento}}</td>
                    </tbody>
                @endforeach
            </table>
            </div>
        </div>
    </div>
@endsection
