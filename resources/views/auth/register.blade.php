@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrar</div>
                    <div class="panel-body">
                        {!! Form::open(array('url' => '/register', 'method' => 'POST', 'class'=>'form-horizontal')) !!}
                        {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">--}}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            {!! Form::label('nombre', 'Nombre',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::text('nombre', null,['class'=>'form-control', 'value'=>"{{ old('nombre') }}"])!!}
                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('nombre') }}</strong>
                                   </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', 'Correo electrónico',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::text('email', null,['class'=>'form-control', 'value'=>"{{ old('email') }}"])!!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('email') }}</strong>
                                   </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Contraseña',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::password('password', array('class'=>'form-control'))!!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('password') }}</strong>
                                   </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>
{{--                            {!! Form::label('password-confirm', 'Confirmar contraseña',['class'=>'col-md-4 control-label'])!!}--}}
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
{{--                                {!! Form::password('password-confirm',array('class'=>'form-control'))!!}--}}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('password_confirmation') }}</strong>
                                   </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            {!! Form::label('role', 'Rol',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('role') }}</strong>
                                   </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('condominio') ? ' has-error' : '' }}">
                            {!! Form::label('condominio', 'Departamento',['class'=>'col-md-4 control-label'])!!}
                            <div class="col-md-6">
                                {!! Form::select('condominio', $condominio, null, ['class' => 'form-control']) !!}
                                @if ($errors->has('condominio'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('condominio') }}</strong>
                                   </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Registrar
                                </button>
                            </div>
                        </div>
                        {{--</form>--}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
