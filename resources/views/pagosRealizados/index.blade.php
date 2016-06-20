@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Pagos realizados</h1>
        <div class="row">
            <a href="{{ url('/pagosRealizados/create') }}"><i class="fa fa-btn fa-plus"></i>Realizar pagos</a>
            <div class="col-md-10 col-md-offset-1">
                <table class="table">
                    <thead>
                    <th>
                        Departamento
                    </th>
                    <th>
                        Concepto
                    </th>
                    <th>
                        Cantidad pagada
                    </th>
                    <th>
                        Fecha de reporte de pago
                    </th>
                    <th>
                        Fecha de pago
                    </th>
                    <th>
                        Evidencia
                    </th>
                    <th>
                        Estatus del pago
                    </th>
                    </thead>
                    @foreach($pagosRealizados as $pago)
                        <tbody>
                        <td>{{$pago->condominio->departamento}}</td>
                        <td>{{$pago->descripcion_pago}}</td>
                        <td>{{$pago->cantidad_pagada}}</td>
                        <td>{{Carbon\Carbon::parse($pago->fecha_reporte_pago)->format('d/m/Y')}}</td>
                        <td>{{Carbon\Carbon::parse($pago->fecha_de_pago)->format('d/m/Y')}}</td>
                        <td>
                            <img alt="{{$pago->nombre_archivo}}" src="/pagosRealizados/{{$pago->id}}/image">‌​
                        </td>
                        <td>{{$pago->estatus->estatus_descripcion}}</td>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
