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
            <h2> Cambio de contraseña del sistema </h2>
        </strong>
    </p>
    <p align="justify">
        Usted a solicitado cambiar su contraseña, si no lo ha solicitado haga caso omiso a este correo, de lo contrario siga leyendo.
    </p>

    <p align="justify">
        De click en el siguiente enlace para cambiar su contraseña: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> "Tu espacio &Aacute;ngel Zimbr&oacute;n" cambio de contraseña </a>
    </p>

    <p align="justify">
        <strong>Atentamente</strong>
        <br/>
        <strong><a>Administraci&oacute;n "Tu espacio &Aacute;ngel Zimbr&oacute;n".</a></strong>
    </p>
</div>
<div>
    <img class="mail_footer" src="{{ $message->embed(public_path().'/images//email_footer.png') }}"/>
</div>
<br/><br/>
</body>
</html>
