@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <section class="mx-auto max-w-6xl">
        <header class="mb-6 border-b border-slate-200 pb-6">
            <h1 class="mt-2 text-3xl font-bold text-slate-900">Projects</h1>
            <p class="mt-2 max-w-2xl text-slate-600">Kumpulan project yang pernah saya kerjakan.</p>
        </header>

        {{-- Form Search, Filter & Sorting --}}
        <form method="GET" action="{{ route('projects.public.index') }}" class="mb-6 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-5">
                {{-- Input Search --}}
                <div class="lg:col-span-2">
                    <label for="search" class="sr-only">Cari project</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul atau deskripsi..."
                        class="w-full rounded-md border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Filter Category --}}
                <div>
                    <label for="category" class="sr-only">Kategori</label>
                    <select id="category" name="category" class="w-full rounded-md border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->slug }}" @selected(request('category') === $c->slug)>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Technology --}}
                <div>
                    <label for="technology" class="sr-only">Teknologi</label>
                    <select id="technology" name="technology" class="w-full rounded-md border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Teknologi</option>
                        @foreach ($technologies as $t)
                            <option value="{{ $t->slug }}" @selected(request('technology') === $t->slug)>
                                {{ $t->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Sorting --}}
                <div>
                    <label for="sort" class="sr-only">Urutkan</label>
                    <select id="sort" name="sort" class="w-full rounded-md border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
                        <option value="terlama" @selected(request('sort') === 'terlama')>Terlama</option>
                        <option value="az" @selected(request('sort') === 'az')>Judul (A - Z)</option>
                    </select>
                </div>
            </div>

            <div class="mt-3 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-3">
                <p class="text-sm text-slate-600">
                    Menampilkan <span class="font-semibold text-slate-900">{{ $projects->total() }}</span> hasil ditemukan
                </p>

                <div class="flex items-center gap-2">
                    @if (request()->hasAny(['search', 'category', 'technology', 'sort']))
                        <a href="{{ route('projects.public.index') }}"
                            class="rounded-md border border-slate-300 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                            Reset
                        </a>
                    @endif
                    <button type="submit"
                        class="rounded-md bg-blue-600 px-4 py-1.5 text-sm font-semibold text-white hover:bg-blue-700">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        {{-- Daftar Project --}}
        @if ($projects->isNotEmpty())
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
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

                                <h2 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">{{ $project->title }}</h2>

                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    {{ $project->short_description ?: \Illuminate\Support\Str::limit($project->description, 140) }}
                                </p>

                                {{-- Badge Technologies --}}
                                @if ($project->technologies->isNotEmpty())
                                    <div class="mt-4 flex flex-wrap gap-1.5">
                                        @foreach ($project->technologies as $tech)
                                            <span class="rounded bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-700">
                                                {{ $tech->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <span class="mt-auto pt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-600">
                                    Lihat detail <span aria-hidden="true">&rarr;</span>
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">{{ $projects->links() }}</div>
        @else
            <div class="rounded-lg border border-slate-200 bg-white py-12 text-center">
                <p class="text-slate-600">Tidak ada project yang cocok dengan pencarian/filter.</p>
                @if (request()->hasAny(['search', 'category', 'technology', 'sort']))
                    <a href="{{ route('projects.public.index') }}" class="mt-3 inline-block text-sm font-semibold text-blue-600 hover:underline">
                        Reset semua filter
                    </a>
                @endif
            </div>
        @endif
    </section>
@endsection