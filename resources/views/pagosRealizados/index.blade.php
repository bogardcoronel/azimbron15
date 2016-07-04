@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="../css/lytebox.css">
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session('success') }}</div>
    @endif
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
                    <th>
                        Comentarios del administrador
                    </th>
</thead>
@foreach($pagosRealizados as $pago)
   <tbody>
   <td> <a href="../pagosRealizados/{{$pago->id}}/show" >{{$pago->condominio->departamento}}</a></td>
   <td>
       <ul class="list-group">
   @foreach($pago->pagosConceptos as $pagoConcepto)
   <li class="list-group-item">{{$pagoConcepto->concepto}}
   </li>
   @endforeach
       </ul>
   </td>
   <td>{{$pago->cantidad_pagada}}</td>
   <td>{{Date::parse($pago->fecha_reporte_pago)->format('l j F Y')}}</td>
   <td>{{Date::parse($pago->fecha_de_pago)->format('l j F Y')}}</td>
   <td>
       @foreach($pago->evidencias as $evidencia)
       <a href="/evidencia/{{$evidencia->id}}/image" class="lytebox" data-title="{{$evidencia->nombre_archivo}}"><i class="fa fa-camera"></i></a>
       @endforeach
   </td>


       @if (Auth::user()->is("Administrador"))
           <td>
               @if ($pago->estatus->id == 2)
           <ul class="list-group">
               <li class="list-group-item-success">
                   <a href="../pagosRealizados/{{$pago->id}}/approve"><i class="fa fa-btn fa-thumbs-o-up"></i> Aprobar pago</a>
               </li>
               <li class="list-group-item-warning">
                   <a href="#"><i class="fa fa-btn fa-hand-stop-o"></i> Rechazar pago</a>
               </li>
           </ul>
           @elseif($pago->estatus->id == 1)
               <a href="#">Pago aceptado</a>
           @endif
               </td>
       @endif
           <td>
   <a href="#">{{$pago->estatus->estatus_descripcion}}</a>
               @if (Auth::user()->is("Condomino"))
                   @if ($pago->estatus->id == 3)
                       <a href="#"><i class="fa fa-btn fa-hand-stop-o"></i>Da click aquí para realizar aclaración</a>
                   @endif
               @endif
   </td>
   <td>{{$pago->comentarios}}</td>


</tbody>
@endforeach
</table>
</div>
</div>
</div>
@endsection
