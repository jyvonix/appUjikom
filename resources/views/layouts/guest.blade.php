<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Smart Exam | Premium Access</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @php
        $manifestPath = public_path('build/manifest.json');
        $cssFile = '';
        if (file_exists($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            $cssFile = $manifest['resources/css/app.css']['file'] ?? '';
        }
    @endphp
    @if($cssFile)
        <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
    @endif

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0; padding: 0;
            overflow-x: hidden;
        }
        .soft-bg {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
            background: radial-gradient(circle at 0% 0%, #eff6ff 0%, #ffffff 50%, #f1f5f9 100%);
        }
        .abstract-shape-1 {
            position: fixed; top: -10%; right: -5%; width: 40%; height: 60%;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(30, 64, 175, 0.02) 100%);
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            z-index: -1; filter: blur(40px);
            animation: float 20s infinite alternate ease-in-out;
        }
        .abstract-shape-2 {
            position: fixed; bottom: -10%; left: -5%; width: 35%; height: 50%;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(251, 191, 36, 0.02) 100%);
            border-radius: 60% 40% 30% 70% / 50% 60% 40% 50%;
            z-index: -1; filter: blur(40px);
            animation: float 25s infinite alternate-reverse ease-in-out;
        }
        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(50px, 30px) rotate(10deg); }
        }
    </style>
</head>
<body class="h-full antialiased flex items-center justify-center p-6 bg-white">
    <div class="soft-bg"></div>
    <div class="abstract-shape-1"></div>
    <div class="abstract-shape-2"></div>
    {{ $slot }}
    @stack('scripts')
</body>
</html>
