    @extends('layouts.app')

    @section('title', 'Profil Saya - Portfolio')

    @section('content')
        <div class="mx-auto max-w-4xl">
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-wide text-blue-600">Akun</p>
                <h1 class="mt-1 text-3xl font-bold text-slate-900">Profil Saya</h1>
            </div>

            <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-6 border-b border-slate-200 p-6 sm:flex-row sm:items-center">
                    @if (Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Foto profil {{ Auth::user()->name }}" class="h-24 w-24 rounded-full object-cover ring-4 ring-blue-50">                    @else
                        <span class="flex h-24 w-24 shrink-0 items-center justify-center rounded-full bg-blue-100 text-3xl font-bold text-blue-700 ring-4 ring-blue-50">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    @endif

                    <div>
                        <h2 class="text-xl font-bold text-slate-900">{{ Auth::user()->name }}</h2>
                        <p class="mt-1 text-slate-600">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-base font-semibold text-slate-900">Foto Profil</h3>
                    <p class="mt-1 text-sm text-slate-600">Pilih gambar JPG, PNG, atau WEBP. Ukuran minimal 200 × 200 piksel, maksimal 5 MB.</p>

                    <form method="POST" action="{{ route('profile.saya.photo.update') }}" enctype="multipart/form-data" class="mt-5 space-y-4">
                        @csrf
                        <div>
                            <label for="profile_photo" class="block text-sm font-medium text-slate-700">Pilih foto</label>
                            <input id="profile_photo" name="profile_photo" type="file" accept="image/jpeg,image/png,image/webp" required class="mt-2 block w-full text-sm text-slate-700 file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
                            @error('profile_photo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if (session('status'))
                            <p class="text-sm font-medium text-emerald-700">{{ session('status') }}</p>
                        @endif

                        <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan Foto
                        </button>
                    </form>
                </div>
            </section>

            <a href="{{ route('projects.index') }}" class="mt-6 inline-flex font-medium text-blue-600 transition hover:text-blue-700">
                Kembali ke daftar project
            </a>
        </div>
    @endsection