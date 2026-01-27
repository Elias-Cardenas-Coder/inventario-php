@props(['title' => 'Página'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Inventario</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-50 to-zinc-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white/50 backdrop-blur-md border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-3xl font-light text-slate-700 tracking-wide">{{ $title }}</h1>
                <p class="text-slate-500 text-sm mt-1 font-light">Gestiona tu inventario de forma sencilla</p>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
