@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 px-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Add New Project</h1>
        
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
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
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="title" type="text" name="title" required placeholder="Masukkan judul project">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                    Category
                </label>
                <select name="category_id" id="category_id" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="short_description">
                    Short Description
                </label>
                <input value="{{ old('short_description') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" id="short_description" type="text" name="short_description" maxlength="255" placeholder="Ringkasan singkat project (opsional)">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="description" rows="5" name="description" required placeholder="Deskripsikan project..."></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Status
                </label>
                <select name="status" id="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <div class="mb-4">
                <span class="block text-gray-700 text-sm font-bold mb-2">Technologies</span>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    @foreach ($technologies as $tech)
                        <label class="inline-flex items-center space-x-2 text-sm text-gray-700">
                            <input type="checkbox" name="technologies[]" value="{{ $tech->id }}"
                                @checked(in_array($tech->id, old('technologies', [])))
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span>{{ $tech->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="project_url">
                    Project URL (Demo)
                </label>
                <input value="{{ old('project_url') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" id="project_url" type="url" name="project_url" placeholder="https://example.com">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="repository_url">
                    Repository URL (GitHub)
                </label>
                <input value="{{ old('repository_url') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" id="repository_url" type="url" name="repository_url" placeholder="https://github.com/username/repo">
            </div>

            <input type="file" name="thumbnail" accept="image/*">
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
@endsection