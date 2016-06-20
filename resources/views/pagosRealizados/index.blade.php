@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="../css/lytebox.css">
    <div class="container">
        <h1>Pagos realizados</h1>
        <div class="row">
            @if (Auth::user()->is("Condomino"))
            <a href="{{ url('/pagosRealizados/create') }}"><i class="fa fa-btn fa-plus"></i>Realizar pagos</a>
            @endif
            <div class="col-md-10 col-md-offset-1">
                <table class="table">
                    <thead>
                    <th>
                        Departamento
                    </th>
                    <th>
                        Pago(s) realizado(s)
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

                        @if (Auth::user()->is("Administrador"))
                            <th>
                            Acciones
                            </th>
                        @endif
                    <th>
                            Estatus del pago
                    </th>
</thead>
@foreach($pagosRealizados as $pago)
   <tbody>
   <td>{{$pago->condominio->departamento}}</td>
   <td>
       <ul class="list-group">
   @foreach($pago->pagosConceptos as $pagoConcepto)
   <li class="list-group-item">{{$pagoConcepto->concepto}}
   </li>
   @endforeach
       </ul>
   </td>
   <td>{{$pago->descripcion_pago}}</td>
   <td>{{$pago->cantidad_pagada}}</td>
   <td>{{Date::parse($pago->fecha_reporte_pago)->format('l j F Y')}}</td>
   <td>{{Date::parse($pago->fecha_de_pago)->format('l j F Y')}}</td>
   <td>
       <a href="/pagosRealizados/{{$pago->id}}/image" class="lytebox" data-title="{{$pago->descripcion_pago}}"><i class="fa fa-camera"></i></a>
   </td>


       @if (Auth::user()->is("Administrador")&& $pago->estatus->id==2)
           <td>
           <ul class="list-group">
               <li class="list-group-item-success">
                   <a href="#"><i class="fa fa-btn fa-thumbs-o-up"></i> Aprobar pago</a>
               </li>
               <li class="list-group-item-warning">
                   <a href="#"><i class="fa fa-btn fa-hand-stop-o"></i> Rechazar pago</a>
               </li>
           </ul>
           @if ($pago->estatus->id==3)
               <a href="#">Pago aceptado</a>
           @endif
               </td>
       @endif
           <td>
   <a href="#">{{$pago->estatus->estatus_descripcion}}</a>
   </td>


</tbody>
@endforeach
</table>
</div>
</div>
</div>
@endsection
