<div class="flex items-center justify-between mb-8">
    <!-- Title and Profile -->
    <div class="flex items-center gap-4">
        <h1 class="text-lg font-bold text-gray-800"> {{ $title ?? 'Unknown' }} </h1>
        
    </div>

    <!-- Time Tracking and Actions -->
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-neutral-800 flex items-center justify-center text-white text-base font-semibold">
                {{ substr(auth()->user()->profile->last_name ?? 'U', 0, 1) }}
            </div>
            <div>
                <h2 class="text-sm font-semibold text-gray-800">{{ auth()->user()->profile->first_name ?? 'User' }}</h2>
                <p class="text-xs text-gray-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
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