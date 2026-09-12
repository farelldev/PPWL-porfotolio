<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    @extends('layouts.app')
    @section('title', 'Home - Portfolio')

    @section('content')
    <div class="flex flex-col items-center justify-center text-center py-20">
        <h1 class="text-5xl font-extrabold text-slate-900 mb-6 tracking-tight">Halo, Selamat Datang!</h1>
        <p class="text-xl text-slate-600 max-w-2xl mb-10 leading-relaxed">
            Saya adalah seorang mahasiswa <strong>software engineer</strong> yang antusias membangun aplikasi menarik. Telusuri portofolio saya untuk melihat proyek-proyek terbaru.
        </p>
        <div class="flex space-x-4">
            <a href="{{ route('projects') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">Lihat Proyek</a>
            <a href="{{ route('about') }}" class="bg-white text-slate-700 border border-slate-300 px-6 py-3 rounded-lg font-semibold hover:bg-slate-50 transition shadow-sm">Tentang Saya</a>
        </div>
    </div>
@endsection
</body>
</html>