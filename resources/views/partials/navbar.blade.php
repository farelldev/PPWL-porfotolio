<nav class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600 tracking-tight">farelldev.</a>
            
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Home</a>
                <a href="{{ route('about') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">About</a>
                <a href="{{ route('education') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Education</a>
                <a href="{{ route('projects') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Projects</a>
            </div>
        </div>
    </div>
</nav>