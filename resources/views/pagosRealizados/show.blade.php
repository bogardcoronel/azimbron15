
@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="../../css/jquery-ui.min.css">
    <link rel="stylesheet" href="../../css/chosen.min.css">
    <link rel="stylesheet" href="../../css/lytebox.css">
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session('success') }}</div>
    @endif
    <div class="container">
        <a href="{{ url('../pagosRealizados/index') }}"><i class="fa fa-btn fa-list"></i>Lista de pagos realizados</a>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Detalle de pago</div>
                    <div class="panel-body">
                        <div>
                            {!! Form::label('fechaDePago', 'Fecha de pago',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::label('fechaDePagoVal', Date::parse($pagoRealizado->fecha_de_pago)->format('l j F Y'))!!}
                            </div>
                        </div>

                        <div>
                            {!! Form::label('depto', 'Departamento',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::label('deptoVal', $pagoRealizado->condominio->departamento)!!}
                            </div>
                        </div>

                        <div>
                            {!! Form::label('depto', 'Conceptos',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                <ul>
                                    @foreach($pagoRealizado->pagosConceptos as $pagoConcepto)
                                        <li>{{$pagoConcepto->concepto}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div>
                            {!! Form::label('fechaDePago', 'Fecha en que se reportó el pago',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::label('fechaDePagoVal', Date::parse($pagoRealizado->fecha_reporte_pago)->format('l j F Y'))!!}
                            </div>
                        </div>
                        <div>
                            {!! Form::label('evidenia', 'Evidencia del pago',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                @foreach($pagoRealizado->evidencias as $evidencia)
                                    <a href="/evidencia/{{$evidencia->id}}/image" class="lytebox" data-title="{{$evidencia->nombre_archivo}}"><i class="fa fa-camera"></i></a>
                                @endforeach
                            </div>
                        </div>
                        @if($pagoRealizado->comentarios)
                        <div>
                            {!! Form::label('Comentarios', 'Comentarios del administrador',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::label('fechaDePagoVal',  $pagoRealizado->comentarios)!!}
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
                @if (Auth::user()->is("Administrador") && $pagoRealizado->estatus->id == 2)
                    <a href=" {{url("/pagosRealizados/$pagoRealizado->id/approve")}}"><i class="fa fa-btn fa-thumbs-o-up"></i> Aprobar pago</a>
                    <a href="#"><i class="fa fa-btn fa-hand-stop-o"></i> Rechazar pago</a>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
