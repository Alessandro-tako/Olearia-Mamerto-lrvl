<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Meta Description -->
    <meta name="description"
        content="Olearia Mamerto è un'azienda agricola che produce olio extravergine di oliva di alta qualità, coltivato in Calabria con passione e tecniche innovative.">

    <!-- Open Graph meta tags for social sharing -->
    <meta property="og:title" content="Olearia Mamerto">
    <meta property="og:description"
        content="Olearia Mamerto produce olio extravergine di oliva di qualità superiore, disponibile online.">
    <meta property="og:image" content="{{ asset('images/fotoprincipale.bmp') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">

    <!-- Twitter meta tags for better sharing on Twitter -->
    <meta name="twitter:title" content="Olearia Mamerto">
    <meta name="twitter:description" content="Olearia Mamerto produce olio extravergine di oliva di qualità superiore.">
    <meta name="twitter:image" content="{{ asset('images/fotoprincipale.bmp') }}">
    <meta name="twitter:card" content="summary_large_image" <!-- Favicon -->
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

    {{-- body con immagine foglie di sfondo --}}
    {{-- <style>
        body {
            background-image: url('/images/bg-texture-olive.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin-top: 200px;
        }
    </style> --}}
    {{-- link aos (animation on scrolling) --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <title>{{ config('app.name') }}</title>
</head>

<body>
    <x-navbar></x-navbar>

    <!-- Success message -->
    @if (session('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" @click="show = false" aria-label="Chiudi"></button>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" @click="show = false" aria-label="Chiudi"></button>
        </div>
    @endif


    <!-- Cookie Banner (Temporaneo) -->
    {{-- <script type="text/javascript">
        var _iub = _iub || [];
        _iub.csConfiguration = { "siteId": 3881849, "cookiePolicyId": 18156025, "lang": "it", "storage": { "useSiteId": true } };
    </script>
    <script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3881849.js"></script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/gpp/stub.js"></script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script> --}}

    {{ $slot }}

    <!-- WhatsApp Icon -->
    <a href="https://wa.me/3382017840" class="whatsapp-icon" target="_blank" aria-label="Contattaci su WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Footer -->
    <x-footer></x-footer>
    {{-- script aos --}}
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Inizializza AOS
        AOS.init({
            duration: 1000, // Durata delle animazioni
            easing: 'ease-in-out',
            once: true // L'animazione si esegue una sola volta
        });
    </script>

</body>

</html>
