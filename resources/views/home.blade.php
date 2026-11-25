@extends('layouts.app')

@section('title', 'Home - Portfolio')

@section('content')
<div class="mx-auto max-w-6xl">
    <section class="flex flex-col items-center justify-center text-center py-16 border-b border-slate-200">
        <h1 class="text-5xl font-extrabold text-slate-900 mb-6 tracking-tight">Halo, Selamat Datang!</h1>
        <p class="text-xl text-slate-600 max-w-2xl mb-10 leading-relaxed">
            Saya adalah seorang mahasiswa <strong>software engineer</strong> yang antusias membangun aplikasi menarik. Telusuri portofolio saya untuk melihat proyek-proyek terbaru.
        </p>
        <div class="flex space-x-4">
            <a href="{{ route('projects.public.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">Lihat Proyek</a>
            <a href="{{ route('about') }}" class="bg-white text-slate-700 border border-slate-300 px-6 py-3 rounded-lg font-semibold hover:bg-slate-50 transition shadow-sm">Tentang Saya</a>
        </div>
    </section>

    {{-- Featured Projects Section --}}
    <section class="py-12 border-b border-slate-200">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Proyek Unggulan</h2>
                <p class="mt-1 text-sm text-slate-600">Beberapa proyek pilihan yang pernah saya kerjakan.</p>
            </div>
            <a href="{{ route('projects.public.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                Lihat semua &rarr;
            </a>
        </div>

        @if ($featured->isNotEmpty())
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featured as $project)
                    <article class="flex flex-col overflow-hidden rounded-lg border border-slate-200 bg-white transition hover:border-blue-200 hover:shadow-sm">
                        <a href="{{ route('projects.public.show', $project->slug) }}" class="group flex flex-1 flex-col">
                            @if ($project->thumbnail)
                                <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->title }}" class="aspect-[16/10] w-full object-cover">
                            @else
                                <div class="flex aspect-[16/10] items-center justify-center bg-slate-100 text-sm font-medium text-slate-400">Project</div>
                            @endif

                            <div class="flex flex-1 flex-col p-5">
                                @if ($project->category)
                                    <span class="mb-2 inline-block w-fit rounded bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">
                                        {{ $project->category->name }}
                                    </span>
                                @endif

                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">{{ $project->title }}</h3>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    {{ $project->short_description ?: \Illuminate\Support\Str::limit($project->description, 120) }}
                                </p>

                                <span class="mt-auto pt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-600">
                                    Lihat detail <span aria-hidden="true">&rarr;</span>
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @else
            <p class="rounded-lg border border-slate-200 bg-white p-6 text-center text-sm text-slate-500">
                Belum ada proyek unggulan yang ditampilkan.
            </p>
        @endif
    </section>

    {{-- Skills Section --}}
    <section class="py-12">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900">Keahlian (Skills)</h2>
            <p class="mt-1 text-sm text-slate-600">Teknologi dan kemampuan yang saya kuasai.</p>
        </div>

        @if ($skills->isNotEmpty())
            <div class="flex flex-wrap gap-2.5">
                @foreach ($skills as $skill)
                    <span class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm">
                        {{ $skill->name }}
                    </span>
                @endforeach
            </div>
        @else
            <p class="text-sm text-slate-500">Belum ada data keahlian.</p>
        @endif
    </section>
</div>
@endsection