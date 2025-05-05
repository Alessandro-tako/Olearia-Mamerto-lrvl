<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sito in Manutenzione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: 'Georgia', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
            background: linear-gradient(to bottom, #1c1c1c, #000);
        }

        .container {
            text-align: center;
            max-width: 800px;
        }

        .epic-img {
            width: 100%;
            max-width: 600px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(255, 140, 0, 0.7);
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ff9900;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        p {
            font-size: 1.2rem;
            color: #ddd;
            margin-top: 1rem;
        }

        .flame-effect {
            animation: flicker 2s infinite;
            color: #ffa500;
        }

        @keyframes flicker {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="flame-effect">Stiamo forgiando per voi</h1>
        <img src="{{ Storage::url('images/manutenzione.png') }}" alt="Sito in manutenzione" class="epic-img img-fluid">
        
        <p>Il fabbro del codice è al lavoro nella sua fucina. <br>
            Torneremo online più forti di prima! 🔥</p>
    </div>

</body>

</html>