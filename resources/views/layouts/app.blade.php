<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSST Coffee — Coffee Companion / Lifestyle Compliment</title>
    <meta name="description" content="Titik singgah buat ngopi. Menemani momen di sela aktivitas harian di Bandung. Nikmati menu kopi familiar dan merchandise resmi SSST via Tokopedia.">
    
    <!-- Open Graph / SEO -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="SSST Coffee — Titik singgah, bukan destinasi.">
    <meta property="og:description" content="Portal brand resmi SSST Coffee. Menu ringkas, outlet Bandung, dan merch Tokopedia.">
    <meta property="og:image" content="{{ asset('images/og-ssst.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Caveat / Kalam -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Kalam:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #1d1d1f;
            color: #f5f5f7;
        }
        .font-doodle {
            font-family: 'Caveat', 'Kalam', cursive;
        }
        .text-ssst-white { color: #f5f5f7; }
        .text-ssst-softgray { color: #cacacc; }
        .text-ssst-lightgray { color: #9f9fa1; }
        .text-ssst-gray { color: #737375; }
        .text-ssst-darkgray { color: #48484a; }
        .bg-ssst-black { background-color: #1d1d1f; }
        .bg-ssst-card { background-color: #171719; }
        .bg-ssst-card-light { background-color: #242428; }
        .border-ssst { border-color: #2f2f33; }
    </style>
</head>
<body class="bg-ssst-black text-ssst-white antialiased selection:bg-white selection:text-black">
    @yield('content')
</body>
</html>

