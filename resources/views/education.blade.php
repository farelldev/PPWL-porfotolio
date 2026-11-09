@extends('layouts.app') 

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4 mb-20">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Riwayat Pendidikan</h1>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Universitas Gadjah Mada</h5>
            <h6 class="mb-2 text-md font-semibold text-blue-600">Teknologi Rekayasa Perangkat Lunak (D4)</h6>
            <p class="font-normal text-gray-700 mb-3">Tahun 2024 - Sekarang</p>
            <p class="text-sm text-gray-500">Berfokus pada pengembangan perangkat lunak, struktur data, dan arsitektur web.</p>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">SMA Negeri 1 Pati</h5>
            <h6 class="mb-2 text-md font-semibold text-blue-600">Peminatan MIPA Murni</h6>
            <p class="font-normal text-gray-700 mb-3">Tahun 2022 - 2025</p>
            <p class="text-sm text-gray-500">Ya belajar materi SMA pada umumnya, pernah belajar dasar algoritma dan logika pemrograman dasar.</p>
        </div>
    </div>
</div>
@endsection
