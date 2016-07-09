@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido</div>

                <div class="panel-body">
                    Bienvenido al sistema "Tu espacio Ángel Zimbrón".  @if (Auth::guest()) <strong> <a href="{{ url('/login') }}">comienza aquí</a></strong>
                    @else
                    <br/>
                        Empieza a explorar ahora tu sistema dando click en alguna opción del menú.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
