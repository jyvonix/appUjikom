<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SmartExam - Intelligence Access</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            letter-spacing: -0.01em;
        }
        .bg-magic {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: 
                radial-gradient(circle at 100% 0%, rgba(37, 99, 235, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 0% 100%, rgba(59, 130, 246, 0.03) 0%, transparent 40%);
        }
        .dots-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(#e2e8f0 1.5px, transparent 1.5px);
            background-size: 32px 32px;
            opacity: 0.4;
            mask-image: radial-gradient(circle at center, black, transparent);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.1);
        }
        .text-gradient-brand {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-brand {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 241, 0.3);
        }
        .input-focus:focus {
            outline: none !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.06) !important;
            border-color: #2563eb !important;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center p-6">
    <div class="bg-magic">
        <div class="dots-pattern"></div>
    </div>
    
    {{ $slot }}

    @stack('scripts')
</body>
</html>
