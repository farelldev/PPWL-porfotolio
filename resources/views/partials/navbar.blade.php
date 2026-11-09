<nav class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600 tracking-tight">farelldev.</a>
            
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Home</a>
                <a href="{{ route('about') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">About</a>
                <a href="{{ route('education') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Education</a>
                <a href="{{ route('experience') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Experience</a>
                <a href="{{ route('projects.public.index') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Projects</a>
            </div>

            @auth
                <div class="flex items-center gap-4 pl-4 border-l border-slate-200">
                    <details class="group relative">
                        <summary class="flex cursor-pointer list-none items-center gap-2 text-sm font-semibold text-slate-700 hover:text-blue-600">
                            Halo, {{ Auth::user()->name }}
                            <span aria-hidden="true" class="h-2 w-2 rotate-45 border-b-2 border-r-2 border-current"></span>
                        </summary>
                        <div class="absolute right-0 mt-3 w-48 overflow-hidden rounded-md border border-slate-200 bg-white py-1 shadow-lg">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600">Dashboard</a>
                            <a href="{{ route('projects.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600">Kelola Projects</a>
                            <a href="{{ route('profile.saya') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600">Profil Saya</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2 text-left text-sm font-medium text-red-600 hover:bg-red-50">Logout</button>
                            </form>
                        </div>
                    </details>
                    <a href="{{ route('profile.saya') }}" aria-label="Profil {{ Auth::user()->name }}" class="shrink-0">
                        @if (Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Foto profil {{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover ring-2 ring-blue-100">
                        @else
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-700 ring-2 ring-blue-100">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        @endif
                    </a>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors">
                    Login
                </a>
            @endguest
        </div>
    </div>
</nav>