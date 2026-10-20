@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Project</h1>

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div class="flex items-center gap-2">
            <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                + Tambah Project Baru
            </a>

            <a href="{{ route('projects.trash') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Lihat Tong Sampah
            </a>
        </div>

        <form action="{{ route('projects.index') }}" method="GET" class="w-full md:max-w-md m-0">
            <div class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul project..." class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Cari
                </button>
                
                @if(request('search'))
                    <a href="{{ route('projects.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Reset
                    </a>
                @endif

                <select name="per_page" onchange="this.form.submit()" class="ml-4 shadow border rounded py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 per halaman</option>
                    <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10 per halaman</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per halaman</option>
                </select>

            </div>

            
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    @if(count($projects) > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow mb-4">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold text-sm">No</th>
                        <th class="py-3 px-4 text-left font-semibold text-sm">Judul Project</th>
                        <th class="py-3 px-4 text-left font-semibold text-sm">Deskripsi</th>
                        <th class="py-3 px-4 text-left font-semibold text-sm">Status</th>
                        <th class="py-3 px-4 text-left font-semibold text-sm">Tanggal Dibuat</th>
                        <th class="py-3 px-4 text-left font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($projects as $index => $project)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $projects->firstItem() + $index }}</td>
                            <td class="py-3 px-4 font-medium">{{ $project->title }}</td>
                            <td class="py-3 px-4">{{ $project->description }}</td>
                            <td class="px-4 py-2 border-b">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $project->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">{{ $project->created_at }}</td>
                            <td class="py-3 px-4 gap-2 flex items-center justify-center gap-2">
                                <a href="{{ route('projects.edit', $project->id) }}" class="bg-teal-500 hover:bg-teal-600 text-white text-sm py-1 px-3 rounded transition duration-300">Edit</a>

                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus project ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm py-1 px-3 rounded transition duration-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

            {{ $projects->links() }}
    @else
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded" role="alert">
            <p>Belum ada data project.</p>
        </div>
    @endif
</div>
@endsection
