@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Project</h1>
    
    <a href="{{ route('projects.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 transition duration-300">
        + Tambah Project Baru
    </a>

    <a href="{{ route('projects.trash') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block ml-2">
        Lihat Tong Sampah
    </a>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    @if(count($projects) > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
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
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
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
    @else
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded" role="alert">
            <p>Belum ada data project.</p>
        </div>
    @endif
</div>
@endsection
