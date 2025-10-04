<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
</head>

<body>
    <h1>RICHIESTA RIFIUTATA</h1>
    <h3>Dati utente:</h3>
    <h5>Nome: {{$user->name}}</h5>
    <h6>Email: {{$user->email}}</h6>
    <p>Hai rifiutato la richiesta per diventare venditore</p>
</body>

</html>