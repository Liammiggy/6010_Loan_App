<div class="flex items-center justify-between mb-8">
    <!-- Title and Profile -->
    <div class="flex items-center gap-4">
        @if(!empty($current_route))
            <a href="{{ $current_route }}" class="text-indigo-600"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                    <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z"/>
                </svg> 
            </a> 
        @endif
        <h1 class="text-lg font-bold text-gray-800"> {{ $title ?? 'Unknown' }} </h1>
        
    </div>

    <!-- Time Tracking and Actions -->
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-neutral-800 flex items-center justify-center text-white text-base font-semibold">
                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
            </div>
            <div>
                <h2 class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'User' }}</h2>
                <p class="text-xs text-gray-500">{{ auth()->user()->username ?? 'username' }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="inline-block ml-8">
            @csrf
            <button type="submit" class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg hover:bg-red-100 transition-colors duration-150 text-sm">
                Logout
            </button>
        </form>
    </div>
</div>