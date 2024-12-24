<!DOCTYPE html>
<html>
<head>
<title>Thank You for connecting with {{ config('deep.brand') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <h2>Dear {{ $data->name }}, </h2>
    <p>Thanks for connecting with us.</p>
    <p>The details provided by you are: </p>
    <p><strong>Email:</strong> {{ $data->email }}</p>
    <p><strong>Phone:</strong> {{ $data->phone }}</p>
    <p><strong>Message:</strong> {{ $data->message }}</p>

    <p>We will reach back to you</p>
    
    <p>Warm Regards</p>
    <h2>Team {{ config('deep.brand') }}</h2>		
</body>
</html>