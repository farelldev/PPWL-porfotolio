<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased flex flex-col min-h-screen">
    @include('partials.navbar')

    <main class="grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-6 mt-auto">
        <div class="container mx-auto px-4 text-center text-slate-500 text-sm">
            @yield('footer', '© 2026 Portfolio. Built with Laravel & Tailwind v4.')
        </div>
    </footer>
</body>
</html>