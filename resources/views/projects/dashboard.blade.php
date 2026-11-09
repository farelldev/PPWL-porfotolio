@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Summary</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <x-stat-card label="Total Projects" :value="$totalProjects" color="text-blue-600" />
        <x-stat-card label="Published" :value="$publishedProjects" color="text-green-600" />
        <x-stat-card label="Drafts" :value="$draftProjects" color="text-yellow-600" />
        <x-stat-card label="Total Skills" :value="$totalSkills" color="text-orange-600" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Panel Project per Kategori -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Project per Kategori</h2>
            <ul class="space-y-3">
                @forelse ($categories as $category)
                    <li class="flex justify-between items-center text-gray-700">
                        <span>{{ $category->name }}</span>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                            {{ $category->projects_count }} Project
                        </span>
                    </li>
                @empty
                    <li class="text-gray-500 italic text-sm">Belum ada data kategori.</li>
                @endforelse
            </ul>
        </div>

        <!-- Panel Skill Teratas -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Top 5 Skills</h2>
            <ul class="space-y-3">
                @forelse ($topSkills as $skill)
                    <li class="flex justify-between items-center text-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold">{{ $loop->iteration }}</span>
                            <span>{{ $skill->name }}</span>
                        </div>
                        <span class="text-sm font-medium text-gray-500">
                            Dipakai di {{ $skill->projects_count }} project
                        </span>
                    </li>
                @empty
                    <li class="text-gray-500 italic text-sm">Belum ada data skill.</li>
                @endforelse
            </ul>
        </div>

    </div>
</div>
@endsection