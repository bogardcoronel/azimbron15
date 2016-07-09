<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css">
        body {
            font-family: Helvetica, Arial;
            color:#464646;
        }

        .mail_header {
            width:600px;
            height: 158px;
        }

        #mail_body {
            padding: 0 80px;
            width:440px;
        }

        .mail_footer {
            width:600px;
            height: 145px;
        }
        h2{
            color:#5082a6;
        }
    </style>
</head>
<body>
<div>
    <img class="mail_header" src="{{ $message->embed(public_path().'/images/email_header.png') }}"/>
</div>
<div id="mail_body" align="center">
    <p align="justify">
        <strong>
            <h2> Pago realizado por el departamento: {{$deptoPaga}} </h2>
        </strong>
    </p>
    <p align="justify">
        El siguiente pago ha sido realizado por la contidad total de: <br/>
        <strong>${{$cantidad_pagada}} MXN </strong> <br/>
        Registrado con fecha de pago: <br/>
        <strong> {{Date::parse($fecha_de_pago)->format('l j F Y')}}</strong>
    </p>
    <p>
        Los conceptos de pago son los siguientes:
    </p>

    <p align="justify">
        {!! $pagos !!}
    </p>

    <p align="justify">
        Para aprobar o solicitar aclaración del pago, es necesario acceder al sistema <strong><a href="{{ $link = url('/pagosRealizados/'.$id.'/show')}}">"Tu espacio &Aacute;ngel Zimbr&oacute;n".</a></strong>.
    </p>

</div>
<div>
    <img class="mail_footer" src="{{ $message->embed(public_path().'/images//email_footer.png') }}"/>
</div>
<br/><br/>
</body>
</html>