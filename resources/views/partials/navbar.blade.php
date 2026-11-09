<nav class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600 tracking-tight">farelldev.</a>
            
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Home</a>
                <a href="{{ route('about') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">About</a>
                <a href="{{ route('education') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Education</a>
                <a href="{{ route('experience') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Experience</a>
                <a href="{{ route('projects.index') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Projects</a>
            </div>

            @auth
                <div class="flex items-center gap-4 pl-4 border-l border-slate-200">
                    <a href="{{ route('profile.saya') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors">
                        Halo, {{ Auth::user()->name }}
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium transition-colors">
                            Logout
                        </button>
                    </form>
                    <a href="{{ route('profile.saya') }}" aria-label="Profil {{ Auth::user()->name }}" class="shrink-0">
                        @if (Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Foto profil {{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover ring-2 ring-blue-100">                        @else
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