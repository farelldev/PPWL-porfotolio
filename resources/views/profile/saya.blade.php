    <div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Profil Saya</h1>
        
        <div class="space-y-3">
            <p><span class="font-semibold text-gray-600">Nama:</span> {{ Auth::user()->name }}</p>
            <p><span class="font-semibold text-gray-600">Email:</span> {{ Auth::user()->email }}</p>
        </div>
        
        <div class="mt-6">
            <a href="{{ route('projects.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Kembali ke Daftar Project
            </a>
        </div>
    </div>
</div>