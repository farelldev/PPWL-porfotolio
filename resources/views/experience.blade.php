@extends('layouts.app') <!-- Sesuaikan dengan nama layout publikmu -->

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4 mb-20">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Pengalaman Kerja</h1>

    <div class="relative border-l border-gray-200 ml-3">
        <div class="mb-10 ml-6">
            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white">
                <svg class="w-3 h-3 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </span>
            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">Asisten Praktikum (Asprak)</h3>
            <time class="block mb-2 text-sm font-normal leading-none text-gray-400">Februari 2026 - Sekarang</time>
            <p class="mb-4 text-base font-normal text-gray-500">Membantu dosen dalam memandu mahasiswa pada mata kuliah Praktikum Pemrograman Komputer Dasar di Universitas Gadjah Mada.</p>
        </div>

        <div class="mb-10 ml-6">
            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white">
                <svg class="w-3 h-3 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </span>
            <h3 class="mb-1 text-lg font-semibold text-gray-900">Fullstack Web Developer</h3>
            <time class="block mb-2 text-sm font-normal leading-none text-gray-400">Juni 2025 - Desember 2025</time>
            <p class="text-base font-normal text-gray-500">Mengembangkan berbagai proyek aplikasi web menggunakan Laravel dan basis data MySQL untuk klien lokal.</p>
        </div>
    </div>
</div>
@endsection