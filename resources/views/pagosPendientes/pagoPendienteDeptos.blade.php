@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <script>
        $(function() {
            $('#tablaPagosPendientes').DataTable({
                "oLanguage": {
                    "sUrl": "/media/datatables-es.txt"
                },
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                iDisplayLength: 10,
                aoColumns: [
                    { "sWidth": "10%", "sClass": "dt-center" },
                    { "sWidth": "40%", "sClass": "dt-center" },
                    { "sWidth": "20%", "sClass": "dt-center" },
                    { "sWidth": "30%", "sClass": "dt-center" }
                ],
                fnDrawCallback: function(oSettings) {
                if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay() || oSettings._iDisplayLength == -1) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }else{
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
                }
            }
            });
        } );
    </script>
    <div class="container">
        <h1>Pagos pendientes</h1>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table id="tablaPagosPendientes" class="display">
                    <thead>
                    <th>
                        Departamento
                    </th>
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
                    <tbody>
                    @foreach($pagosPendientes as $pagoPendiente)
                        <tr>
                        <td>{{$pagoPendiente->depto}}</td>
                        <td>{{$pagoPendiente->concepto}}</td>
                        <td>{{$pagoPendiente->cantidad}}</td>
                        <td>{{Carbon\Carbon::parse($pagoPendiente->fecha_limite_pago)->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

