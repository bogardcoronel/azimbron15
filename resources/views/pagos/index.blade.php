@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <a href="{{ url('/pagos/create') }}"><i class="fa fa-btn fa-plus"></i>Agregar pago</a>
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
                @foreach($pagos as $pago)
                    <tbody>
                    <td>{{$pago->concepto}}</td>
                    <td>{{$pago->cantidad}}</td>
                    <td>{{Carbon\Carbon::parse($pago->fecha_limite_pago)->format('d/m/Y')}}</td>
                    </tbody>
                @endforeach
            </table>
            </div>
        </div>
    </div>
@endsection
