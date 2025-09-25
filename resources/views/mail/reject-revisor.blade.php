<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    <h1>RICHIESTA RIFIUTATA</h1>
    <p>Nome: {{$user->name}}</p>
    <p>Email: {{$user->email}}</p>
    <p>Siamo spiacenti ma la tua richiesta di collaborare con noi è stata rifiutata</p>
</body>

</html>