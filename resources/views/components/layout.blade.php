<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- banner cookie -->
    {{-- <script type="text/javascript">
        var _iub = _iub || [];
        _iub.csConfiguration = { "siteId": 3881849, "cookiePolicyId": 18156025, "lang": "it", "storage": { "useSiteId": true } };
    </script>
    <script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3881849.js"></script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/gpp/stub.js"></script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script> --}}
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Olearia Mamerto</title>
</head>
<body>
    <x-navbar></x-navbar>
    {{$slot}}
    <a href="https://wa.me/3382017840" class="whatsapp-icon" target="_blank">
        <i class="bi bi-whatsapp"></i>
    </a>
    <x-footer></x-footer>
</body>
</html>