@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4 mb-20">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Riwayat Pendidikan</h1>

    <div class="grid gap-6 md:grid-cols-2">
        @forelse ($educations as $edu)
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $edu->institution }}</h5>
                <h6 class="mb-2 text-md font-semibold text-blue-600">{{ $edu->degree }}</h6>
                <p class="font-normal text-gray-700 mb-3">{{ $edu->period }}</p>
                <p class="text-sm text-gray-500">{{ $edu->description }}</p>
            </div>
        @empty
            <p class="col-span-2 text-center text-gray-500">Belum ada data riwayat pendidikan.</p>
        @endforelse
    </div>
</div>
@endsection