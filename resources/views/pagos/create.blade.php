
@extends('layouts.app')

@section('content')
    {{--<script src="../js/inputmask.js"></script>--}}
    {{--<script src="../js/inputmask.numeric.extensions.js"></script>--}}
    {{--<script src="../js/jquery.inputmask.js"></script>--}}

    <link rel="stylesheet" href="../css/jquery-ui.min.css">
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrar pago</div>
                    <div class="panel-body">
                        {!! Form::open(array('url' => '/pagos/store', 'method' => 'POST', 'class'=>'form-horizontal')) !!}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('concepto') ? ' has-error' : '' }}">
                            {!! Form::label('concepto', 'Concepto de pago',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::text('concepto', null,['class'=>'form-control', 'value'=>"{{ old('concepto') }}"])!!}
                                @if ($errors->has('concepto'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('concepto') }}</strong>
                                   </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
                            {!! Form::label('cantidad', 'Cantidad de pago $',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::text('cantidad', null,['class'=>'form-control', 'value'=>"{{ old('cantidad') }}"])!!}
                                @if ($errors->has('cantidad'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('cantidad') }}</strong>
                                   </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fecha_limite_pago') ? ' has-error' : '' }}">
                            {!! Form::label('fecha_limite_pago', 'Fecha límite de pago',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::text('fecha_limite_pago', null,['class'=>'form-control', 'value'=>"{{ old('fecha_limite_pago') }}"])!!}
                                @if ($errors->has('fecha_limite_pago'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('fecha_limite_pago') }}</strong>
                                   </span>
                                @endif
                            </div>
                        </div>
</div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-database"></i> Crear
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
