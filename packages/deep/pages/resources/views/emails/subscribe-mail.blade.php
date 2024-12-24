<!DOCTYPE html>
<html>
<head>
<title>Thank You for subscribing {{ config('deep.brand') }}</title>
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
    <h2>@if( optional($data->user)->name ) Dear {{ optional($data->user)->name }} @else Hi, @endif</h2>
    <p>Thanks for subscribing to {{ config('deep.brand') }}.</p>
    <p>Your Details are : </p>
    <ul>
        <li>Email : {{ $data->email }}</li>
    </ul>
    <p>We will keep you posted for new blogs and offers that we come up with.</p>
    
    <p>Warm Regards</p>
    <h2>Team {{ config('deep.brand') }}</h2>
</body>
</html>