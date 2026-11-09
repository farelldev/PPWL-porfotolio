@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 px-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Edit Project</h1>
        
        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops! Ada kesalahan.</strong>
                    <ul class="list-disc pl-5 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input value="{{ $project->title ?? old('title') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="title" type="text" name="title" required placeholder="Masukkan judul project">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="description" rows="5" name="description" required placeholder="Deskripsikan project...">
{{ $project->description ?? old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Status
                </label>
                <select name="status" id="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="draft" {{ $project->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $project->status == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            <input class="mb-6" type="file" name="thumbnail" accept="image/*">
            @error('thumbnail')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            
            <div class="flex items-center justify-between">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300" type="submit">
                    Submit
                </button>

                <a href="{{ route('projects.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<section class="max-w-6xl mx-auto mb-10 px-4">
    <div class="border-t border-slate-200 pt-8">
        <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Gallery Project</h2>
                <p class="mt-1 text-sm text-slate-600">{{ $project->images->count() }} dari 10 gambar</p>
            </div>
            @if ($project->status === 'published')
                <a href="{{ route('projects.public.show', $project->slug) }}" target="_blank" class="font-medium text-blue-600 hover:text-blue-700">Lihat halaman publik</a>
            @endif
        </div>

        @if (session('success'))
            <p class="mb-4 text-sm font-medium text-emerald-700">{{ session('success') }}</p>
        @endif

        @if ($project->images->isNotEmpty())
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($project->images as $image)
                    <article class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                        <img src="{{ asset('storage/'.$image->image) }}" alt="{{ $image->caption ?: $project->title }}" class="aspect-[4/3] w-full object-cover">
                        <div class="space-y-3 p-4">
                            <form method="POST" action="{{ route('projects.gallery.update', [$project, $image]) }}" class="space-y-3">
                                @csrf
                                @method('PUT')
                                <label for="caption-{{ $image->id }}" class="block text-sm font-medium text-slate-700">Caption</label>
                                <input id="caption-{{ $image->id }}" name="caption" value="{{ old('caption', $image->caption) }}" maxlength="255" class="w-full rounded-md border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                                <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">Simpan caption</button>
                            </form>
                            <form method="POST" action="{{ route('projects.gallery.destroy', [$project, $image]) }}" onsubmit="return confirm('Hapus gambar ini dari gallery?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">Hapus gambar</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        @if ($project->images->count() < 10)
            <form method="POST" action="{{ route('projects.gallery.store', $project) }}" enctype="multipart/form-data" class="mt-6 rounded-lg border border-dashed border-slate-300 bg-white p-5">
                @csrf
                <label for="gallery-images" class="block text-sm font-semibold text-slate-800">Tambah gambar</label>
                <p class="mt-1 text-sm text-slate-600">Pilih maksimal {{ 10 - $project->images->count() }} gambar lagi. Maksimal 4 MB per gambar.</p>
                <input id="gallery-images" type="file" name="images[]" accept="image/jpeg,image/png,image/webp" multiple required class="mt-3 block w-full text-sm text-slate-700">
                @error('images')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @foreach ($errors->get('images.*') as $messages)
                    @foreach ($messages as $message)
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @endforeach
                @endforeach
                <button type="submit" class="mt-4 rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Unggah gambar</button>
            </form>
        @endif
    </div>
</section>
@endsection