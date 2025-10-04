<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    <h1>RICHIESTA ACCETTATA</h1>
    <p>Nome: {{$user->name}}</p>
    <p>Email: {{$user->email}}</p>
    <h3>Benvenuto nella famiglia di Presto!</h3>
    <p>Entra nella piattaforma e inizia a publicare gli articoli!</p>
</body>

</html>