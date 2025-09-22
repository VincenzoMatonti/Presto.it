<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}} - {{$title}}</title>
    <!-- CDN fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <!-- Bundling asset -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-shared.navbar />

    <div class="min-vh-100">
        {{$slot}}
    </div>

    <x-shared.footer />
</body>

</html>