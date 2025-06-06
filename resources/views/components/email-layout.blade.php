<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Meta Description -->
    <meta name="description" content="Olearia Mamerto è un'azienda agricola che produce olio extravergine di oliva di alta qualità, coltivato in Calabria con passione e tecniche innovative.">

    <!-- Open Graph meta tags for social sharing -->
    <meta property="og:title" content="Olearia Mamerto">
    <meta property="og:description" content="Olearia Mamerto produce olio extravergine di oliva di qualità superiore, disponibile online.">
    <meta property="og:image" content="{{ asset('images/fotoprincipale.bmp') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">

    <!-- Twitter meta tags for better sharing on Twitter -->
    <meta name="twitter:title" content="Olearia Mamerto">
    <meta name="twitter:description" content="Olearia Mamerto produce olio extravergine di oliva di qualità superiore.">
    <meta name="twitter:image" content="{{ asset('images/fotoprincipale.bmp') }}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&display=swap" rel="stylesheet">

    <!-- Vite for custom styles and scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ config('app.name') }}</title>
</head>

<body>
    {{ $slot }}
    <!-- Footer -->
    <x-footer></x-footer>

</body>

</html>
