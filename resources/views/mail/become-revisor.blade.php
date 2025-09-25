<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
</head>
<body>
    <div>
        <h1>Un utente ha richiesto di lavorare con noi</h1>
        <h2>Ecco i suoi dati:</h2>
        <p>Nome: {{$user->name}}</p>
        <p>Email: {{$user->email}}</p>
        <p>Se vuoi renderl* revisor,clicca qui:</p>
        <a href="{{ route('make.revisor', compact('user')) }}">Rendi revisore</a>
        <p>Altrimenti rifiuta la richiesta:</p>
        <a href="{{ route('reject.revisor', compact('user')) }}">Rifiuta richiesta</a>
    </div>
</body>
</html>