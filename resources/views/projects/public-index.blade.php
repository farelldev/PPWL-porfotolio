@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <section class="mx-auto max-w-6xl">
        <header class="mb-8 border-b border-slate-200 pb-6">
            <h1 class="mt-2 text-3xl font-bold text-slate-900">Projects</h1>
            <p class="mt-2 max-w-2xl text-slate-600">Kumpulan project yang pernah saya kerjakan.</p>
        </header>

        @if ($projects->isNotEmpty())
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <article class="overflow-hidden rounded-lg border border-slate-200 bg-white transition hover:border-blue-200 hover:shadow-sm">
                        <a href="{{ route('projects.public.show', $project->slug) }}" class="group block">
                            @if ($project->thumbnail)
                                <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->title }}" class="aspect-[16/10] w-full object-cover">
                            @else
                                <div class="flex aspect-[16/10] items-center justify-center bg-slate-100 text-sm font-medium text-slate-400">Project</div>
                            @endif
                            <div class="p-5">
                                <h2 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">{{ $project->title }}</h2>
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit($project->description, 140) }}</p>
                                <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-600">Lihat detail <span aria-hidden="true">&rarr;</span></span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">{{ $projects->links() }}</div>
        @else
            <p class="border-y border-slate-200 py-8 text-slate-600">Belum ada project yang dipublikasikan.</p>
        @endif
    </section>
@endsection