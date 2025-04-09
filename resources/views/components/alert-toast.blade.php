@props(['type' => 'success', 'message' => '', 'duration' => 3000])

<div x-data="{ show: true }"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-2"
     x-init="setTimeout(() => show = false, {{ $duration }})"
     class="fixed top-4 right-4 z-50 max-w-sm w-full">
    <div class="rounded-lg shadow-lg overflow-hidden
        {{ $type === 'success' ? 'bg-green-50 border border-green-200' : '' }}
        {{ $type === 'error' ? 'bg-red-50 border border-red-200' : '' }}
        {{ $type === 'warning' ? 'bg-yellow-50 border border-yellow-200' : '' }}
        {{ $type === 'info' ? 'bg-blue-50 border border-blue-200' : '' }}">
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    @if($type === 'success')
                        <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    @elseif($type === 'error')
                        <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    @elseif($type === 'warning')
                        <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    @else
                        <svg class="h-6 w-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endif
                </div>
                <div class="ml-3 w-0 flex-1">
                    <p class="text-sm font-medium
                        {{ $type === 'success' ? 'text-green-800' : '' }}
                        {{ $type === 'error' ? 'text-red-800' : '' }}
                        {{ $type === 'warning' ? 'text-yellow-800' : '' }}
                        {{ $type === 'info' ? 'text-blue-800' : '' }}">
                        {{ $message }}
                    </p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="show = false" class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> 