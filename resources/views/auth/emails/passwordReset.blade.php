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
            <h2> Estimado usuario: {{$nombre}} </h2>
        </strong>
    </p>
    <p align="justify">
        Usted ha cambiado su contraseña de ingreso al sistema
        <strong><a href="http://www.angelzimbron15.esy.es">"Tu espacio &Aacute;ngel Zimbr&oacute;n"</a></strong>

    </p>
    <p>
        Sus datos de acceso son los siguientes:
    </p>

    <p align="justify">
        <strong>Correo electr&oacute;nico: </strong> {{$email}}</strong>
        <br/>
        <strong>Contrase&ntilde;a: </strong>{{$contrasenhaDes}}</strong>
    </p>

    <p align="justify">
        Es importante recordar estos datos cada vez que desee hacer uso de nuestro sistema.
    </p>
    <p>
        Cons&eacute;rvelos en un lugar seguro.
    </p>

    <p align="justify">
        <strong>Atentamente</strong>
        <br/>
        <strong><a href="http://www.angelzimbron15.esy.es">Administraci&oacute;n "Tu espacio &Aacute;ngel Zimbr&oacute;n".</a></strong>
    </p>
</div>
<div>
    <img class="mail_footer" src="{{ $message->embed(public_path().'/images//email_footer.png') }}"/>
</div>
<br/><br/>
</body>
</html>