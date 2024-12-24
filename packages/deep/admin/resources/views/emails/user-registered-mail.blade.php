<!DOCTYPE html>
<html>
    <head>
        <title>Registeration done on {{ config('deep.brand') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            body{
                padding: 1em 2em;
            }
            button{
                margin: 1em 0;
                background: #e20574;
                border: none;
                padding: 1em 2em;
                color: #fff;
                border-radius: 5px;
            }
            button a{
                color: #fff;
                text-decoration: none;
            }
            a.ssy{
                color:  #e20574;
            }
            .logo-img{
                max-width: 130px;
                height: auto;
            }
        </style>	
    </head>
    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <h2>Dear {{ $data->name }}</h2>
        <p>Thank you for registering with us.</p>
        
        <p>Warm Regards</p>
        <h2>Team <a href="{{ route('home') }}">{{ config('deep.brand') }}</a></h2>
    </body>
</html>