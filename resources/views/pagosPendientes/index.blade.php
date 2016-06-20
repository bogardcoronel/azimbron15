@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Pagos pendientes</h1>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="table">
                    <thead>
                    <th>
                        Concepto
                    </th>
                    <th>
                        Cantidad
                    </th>
                    <th>
                        Fecha límite de pago
                    </th>
                    </thead>
                    @foreach($pagosPendientes as $pagoPendiente)
                        <tbody>
                        <td>{{$pagoPendiente->concepto}}</td>
                        <td>{{$pagoPendiente->cantidad}}</td>
                        <td>{{Carbon\Carbon::parse($pagoPendiente->fecha_limite_pago)->format('d/m/Y')}}</td>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
