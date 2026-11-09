@extends('layouts.app')

@section('title', $project->title.' - Portfolio')

@section('content')
    <article class="mx-auto max-w-6xl">
        <a href="{{ route('projects.public.index') }}" class="mb-6 inline-flex font-medium text-blue-600 hover:text-blue-700">&larr; Semua project</a>

        <header class="border-b border-slate-200 pb-8">
            <p class="text-sm font-semibold uppercase tracking-wide text-blue-600">Project</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-900 sm:text-4xl">{{ $project->title }}</h1>
            <p class="mt-5 max-w-3xl whitespace-pre-line leading-7 text-slate-600">{{ $project->description }}</p>
        </header>

        @if ($project->thumbnail)
            <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->title }}" class="mt-8 max-h-[34rem] w-full rounded-lg object-cover">
        @endif

        <section class="py-10">
            <div class="mb-5 flex items-end justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Gallery</h2>
                    <p class="mt-1 text-sm text-slate-600">{{ $project->images->count() }} gambar</p>
                </div>
            </div>

            @if ($project->images->isNotEmpty())
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($project->images as $image)
                        <figure class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                            <img src="{{ asset('storage/'.$image->image) }}" alt="{{ $image->caption ?: $project->title }}" class="aspect-[4/3] w-full object-cover">
                            @if ($image->caption)
                                <figcaption class="px-4 py-3 text-sm text-slate-700">{{ $image->caption }}</figcaption>
                            @endif
                        </figure>
                    @endforeach
                </div>
            @else
                <p class="border-y border-slate-200 py-6 text-slate-600">Belum ada gambar untuk project ini.</p>
            @endif
        </section>
    </article>
@endsection