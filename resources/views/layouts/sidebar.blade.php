<!-- Sidebar -->
<div x-data="{ 
        isCollapsed: false,
        toggleSidebar() {
            this.isCollapsed = !this.isCollapsed;
            $dispatch('sidebar-toggle', this.isCollapsed);
        }
     }" 
     :class="{ 'w-64': !isCollapsed, 'w-16': isCollapsed }"
     class="fixed left-0 top-0 h-screen w-64 bg-white shadow-lg p-2 transition-all duration-300 z-50">
    
    <!-- Top Section with Title and Toggle -->
    <div class="flex items-center justify-between mb-4">
        <!-- App Title -->
        <h1 x-show="!isCollapsed" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            class="text-xl font-semibold text-gray-800">Loan App</h1>
        
        <!-- Toggle Button -->
        <button @click="toggleSidebar()" 
                :class="{ 'ml-auto': isCollapsed }"
                class="p-1 rounded-lg bg-gray-100 hover:bg-gray-200 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path x-show="!isCollapsed" 
                      stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                <path x-show="isCollapsed" 
                      stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      d="M13 5l7 7 7 7M5 5l7 7 7 7" />
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <nav class="space-y-4">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
            class="relative flex items-center gap-2 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-md group {{ request()->routeIs('dashboard') ? 'bg-neutral-800 text-white' : '' }}" 
            :class="{ 'justify-center': isCollapsed }">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zM8 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H9a1 1 0 01-1-1V4zM15 3a1 1 0 00-1 1v12a1 1 0 001 1h2a1 1 0 001-1V4a1 1 0 00-1-1h-2z" />
                </svg>
            </div>
            <span x-show="!isCollapsed" class="whitespace-nowrap">Dashboard</span>
            <div x-show="isCollapsed" class="absolute left-full top-1/2 -translate-y-1/2 ml-4 pl-2 pointer-events-none hidden group-hover:block">
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-x-1 -translate-y-1/2 w-2 h-2 bg-gray-800 transform rotate-45"></div>
                    <div class="bg-gray-800 text-white text-xs rounded-md py-1 px-2 whitespace-nowrap shadow-lg">Dashboard</div>
                </div>
            </div>
        </a>
        @if(auth()->user()->hasPermission('loan_disburse') || auth()->user()->hasPermission('repayment_schedule'))
        <a href="{{ route('disbursements-and-repayments') }}" 
            class="relative flex items-center gap-2 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-md group {{ request()->routeIs('disbursements-and-repayments') ? 'bg-neutral-800 text-white' : '' }}" 
            :class="{ 'justify-center': isCollapsed }">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 576 512" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 64C28.7 64 0 92.7 0 128L0 384c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64L64 64zm48 160l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zM96 336c0-8.8 7.2-16 16-16l352 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-352 0c-8.8 0-16-7.2-16-16zM376 160l80 0c13.3 0 24 10.7 24 24l0 48c0 13.3-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24l0-48c0-13.3 10.7-24 24-24z"/></svg>
            </div>
            <span x-show="!isCollapsed" class="whitespace-nowrap">
                @if(auth()->user()->hasPermission('loan_disburse') && auth()->user()->hasPermission('repayment_schedule'))
                    Disbursements & Repayments
                @elseif(auth()->user()->hasPermission('loan_disburse'))
                    Disbursements
                @elseif(auth()->user()->hasPermission('repayment_schedule'))
                    Repayments
                @endif
            </span>
            <div x-show="isCollapsed" class="absolute left-full top-1/2 -translate-y-1/2 ml-4 pl-2 pointer-events-none hidden group-hover:block">
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-x-1 -translate-y-1/2 w-2 h-2 bg-gray-800 transform rotate-45"></div>
                    <div class="bg-gray-800 text-white text-xs rounded-md py-1 px-2 whitespace-nowrap shadow-lg">Disbursements and Repayments</div>
                </div>
            </div>
        </a>
        @endif
        @if(auth()->user()->hasPermission('loan_apps_view'))
        <a href="{{ route('loan-applications') }}" 
            class="relative flex items-center gap-2 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-md group {{ request()->routeIs('loan-applications') ? 'bg-neutral-800 text-white' : '' }}" 
            :class="{ 'justify-center': isCollapsed }">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 576 512" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 125.7-86.8 86.8c-10.3 10.3-17.5 23.1-21 37.2l-18.7 74.9c-2.3 9.2-1.8 18.8 1.3 27.5L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z"/></svg>
            </div>
            <span x-show="!isCollapsed" class="whitespace-nowrap">Loan Applications</span>
            <div x-show="isCollapsed" class="absolute left-full top-1/2 -translate-y-1/2 ml-4 pl-2 pointer-events-none hidden group-hover:block">
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-x-1 -translate-y-1/2 w-2 h-2 bg-gray-800 transform rotate-45"></div>
                    <div class="bg-gray-800 text-white text-xs rounded-md py-1 px-2 whitespace-nowrap shadow-lg">Loan Applications</div>
                </div>
            </div>
        </a>
        @endif
        @if(auth()->user()->hasPermission('loan_types_view'))
        <a href="{{ route('loan-types') }}" 
            class="relative flex items-center gap-2 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-md group {{ request()->routeIs('loan-types') ? 'bg-neutral-800 text-white' : '' }}" 
            :class="{ 'justify-center': isCollapsed }">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 384 512" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM112 256l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
            </div>
            <span x-show="!isCollapsed" class="whitespace-nowrap">Loan Types</span>
            <div x-show="isCollapsed" class="absolute left-full top-1/2 -translate-y-1/2 ml-4 pl-2 pointer-events-none hidden group-hover:block">
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-x-1 -translate-y-1/2 w-2 h-2 bg-gray-800 transform rotate-45"></div>
                    <div class="bg-gray-800 text-white text-xs rounded-md py-1 px-2 whitespace-nowrap shadow-lg">Loan Types</div>
                </div>
            </div>
        </a>
        @endif
        @if(auth()->user()->hasPermission('members_view'))
        <a href="{{ route('members') }}" 
            class="relative flex items-center gap-2 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-md group {{ request()->routeIs('members') ? 'bg-neutral-800 text-white' : '' }}" 
            :class="{ 'justify-center': isCollapsed }">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 640 512" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M48 48l88 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L32 0C14.3 0 0 14.3 0 32L0 136c0 13.3 10.7 24 24 24s24-10.7 24-24l0-88zM175.8 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-26.5 32C119.9 256 96 279.9 96 309.3c0 14.7 11.9 26.7 26.7 26.7l56.1 0c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4l-69.3 0zm368 80c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3l-69.3 0c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6l56.1 0zm-89.4 0c-8.6-24.3-29.9-42.6-55.9-47c-3.9-.7-7.9-1-12-1l-80 0c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24l176 0c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24zM464 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-80-32a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM504 48l88 0 0 88c0 13.3 10.7 24 24 24s24-10.7 24-24l0-104c0-17.7-14.3-32-32-32L504 0c-13.3 0-24 10.7-24 24s10.7 24 24 24zM48 464l0-88c0-13.3-10.7-24-24-24s-24 10.7-24 24L0 480c0 17.7 14.3 32 32 32l104 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-88 0zm456 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l104 0c17.7 0 32-14.3 32-32l0-104c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 88-88 0z"/></svg>
            </div>
            <span x-show="!isCollapsed" class="whitespace-nowrap">Members</span>
            <div x-show="isCollapsed" class="absolute left-full top-1/2 -translate-y-1/2 ml-4 pl-2 pointer-events-none hidden group-hover:block">
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-x-1 -translate-y-1/2 w-2 h-2 bg-gray-800 transform rotate-45"></div>
                    <div class="bg-gray-800 text-white text-xs rounded-md py-1 px-2 whitespace-nowrap shadow-lg">Members</div>
                </div>
            </div>
        </a>
        @endif
        {{-- <a href="{{ route('payments-and-transactions') }}" 
            class="relative flex items-center gap-2 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-md group {{ request()->routeIs('payments-and-transactions') ? 'bg-neutral-800 text-white' : '' }}" 
            :class="{ 'justify-center': isCollapsed }">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 384 512" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM80 64l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L80 96c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96l192 0c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32L96 352c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32zm0 32l0 64 192 0 0-64L96 256zM240 416l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
            </div>
            <span x-show="!isCollapsed" class="whitespace-nowrap">Payments & Transactions</span>
            <div x-show="isCollapsed" class="absolute left-full top-1/2 -translate-y-1/2 ml-4 pl-2 pointer-events-none hidden group-hover:block">
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-x-1 -translate-y-1/2 w-2 h-2 bg-gray-800 transform rotate-45"></div>
                    <div class="bg-gray-800 text-white text-xs rounded-md py-1 px-2 whitespace-nowrap shadow-lg">Payments and Transactions</div>
                </div>
            </div>
        </a> --}}
        @if(auth()->user()->hasPermission('users_view') || auth()->user()->hasPermission('roles_manage'))
        <a href="{{ route('user-management') }}" 
            class="relative flex items-center gap-2 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-md group {{ request()->routeIs('user-management') ? 'bg-neutral-800 text-white' : '' }}" 
            :class="{ 'justify-center': isCollapsed }">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 640 512" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M144 160A80 80 0 1 0 144 0a80 80 0 1 0 0 160zm368 0A80 80 0 1 0 512 0a80 80 0 1 0 0 160zM0 298.7C0 310.4 9.6 320 21.3 320l213.3 0c.2 0 .4 0 .7 0c-26.6-23.5-43.3-57.8-43.3-96c0-7.6 .7-15 1.9-22.3c-13.6-6.3-28.7-9.7-44.6-9.7l-42.7 0C47.8 192 0 239.8 0 298.7zM320 320c24 0 45.9-8.8 62.7-23.3c2.5-3.7 5.2-7.3 8-10.7c2.7-3.3 5.7-6.1 9-8.3C410 262.3 416 243.9 416 224c0-53-43-96-96-96s-96 43-96 96s43 96 96 96zm65.4 60.2c-10.3-5.9-18.1-16.2-20.8-28.2l-103.2 0C187.7 352 128 411.7 128 485.3c0 14.7 11.9 26.7 26.7 26.7l300.6 0c-2.1-5.2-3.2-10.9-3.2-16.4l0-3c-1.3-.7-2.7-1.5-4-2.3l-2.6 1.5c-16.8 9.7-40.5 8-54.7-9.7c-4.5-5.6-8.6-11.5-12.4-17.6l-.1-.2-.1-.2-2.4-4.1-.1-.2-.1-.2c-3.4-6.2-6.4-12.6-9-19.3c-8.2-21.2 2.2-42.6 19-52.3l2.7-1.5c0-.8 0-1.5 0-2.3s0-1.5 0-2.3l-2.7-1.5zM533.3 192l-42.7 0c-15.9 0-31 3.5-44.6 9.7c1.3 7.2 1.9 14.7 1.9 22.3c0 17.4-3.5 33.9-9.7 49c2.5 .9 4.9 2 7.1 3.3l2.6 1.5c1.3-.8 2.6-1.6 4-2.3l0-3c0-19.4 13.3-39.1 35.8-42.6c7.9-1.2 16-1.9 24.2-1.9s16.3 .6 24.2 1.9c22.5 3.5 35.8 23.2 35.8 42.6l0 3c1.3 .7 2.7 1.5 4 2.3l2.6-1.5c16.8-9.7 40.5-8 54.7 9.7c2.3 2.8 4.5 5.8 6.6 8.7c-2.1-57.1-49-102.7-106.6-102.7zm91.3 163.9c6.3-3.6 9.5-11.1 6.8-18c-2.1-5.5-4.6-10.8-7.4-15.9l-2.3-4c-3.1-5.1-6.5-9.9-10.2-14.5c-4.6-5.7-12.7-6.7-19-3l-2.9 1.7c-9.2 5.3-20.4 4-29.6-1.3s-16.1-14.5-16.1-25.1l0-3.4c0-7.3-4.9-13.8-12.1-14.9c-6.5-1-13.1-1.5-19.9-1.5s-13.4 .5-19.9 1.5c-7.2 1.1-12.1 7.6-12.1 14.9l0 3.4c0 10.6-6.9 19.8-16.1 25.1s-20.4 6.6-29.6 1.3l-2.9-1.7c-6.3-3.6-14.4-2.6-19 3c-3.7 4.6-7.1 9.5-10.2 14.6l-2.3 3.9c-2.8 5.1-5.3 10.4-7.4 15.9c-2.6 6.8 .5 14.3 6.8 17.9l2.9 1.7c9.2 5.3 13.7 15.8 13.7 26.4s-4.5 21.1-13.7 26.4l-3 1.7c-6.3 3.6-9.5 11.1-6.8 17.9c2.1 5.5 4.6 10.7 7.4 15.8l2.4 4.1c3 5.1 6.4 9.9 10.1 14.5c4.6 5.7 12.7 6.7 19 3l2.9-1.7c9.2-5.3 20.4-4 29.6 1.3s16.1 14.5 16.1 25.1l0 3.4c0 7.3 4.9 13.8 12.1 14.9c6.5 1 13.1 1.5 19.9 1.5s13.4-.5 19.9-1.5c7.2-1.1 12.1-7.6 12.1-14.9l0-3.4c0-10.6 6.9-19.8 16.1-25.1s20.4-6.6 29.6-1.3l2.9 1.7c6.3 3.6 14.4 2.6 19-3c3.7-4.6 7.1-9.4 10.1-14.5l2.4-4.2c2.8-5.1 5.3-10.3 7.4-15.8c2.6-6.8-.5-14.3-6.8-17.9l-3-1.7c-9.2-5.3-13.7-15.8-13.7-26.4s4.5-21.1 13.7-26.4l3-1.7zM472 384a40 40 0 1 1 80 0 40 40 0 1 1 -80 0z"/></svg>
            </div>
            <span x-show="!isCollapsed" class="whitespace-nowrap">User & Roles </span>
            <div x-show="isCollapsed" class="absolute left-full top-1/2 -translate-y-1/2 ml-4 pl-2 pointer-events-none hidden group-hover:block">
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-x-1 -translate-y-1/2 w-2 h-2 bg-gray-800 transform rotate-45"></div>
                    <div class="bg-gray-800 text-white text-xs rounded-md py-1 px-2 whitespace-nowrap shadow-lg">User & Roles </div>
                </div>
            </div>
        </a>
        @endif
    </nav>

    <!-- Bottom Actions -->
    <div class="absolute inset-x-0 bottom-0 border-t border-gray-200 px-2 py-1">
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center gap-2 px-3 py-1.5 text-sm text-red-600 hover:bg-red-50 rounded-md group"
                    :class="{ 'justify-center': isCollapsed }">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span x-show="!isCollapsed" 
                      x-transition:enter="transition ease-out duration-300"
                      x-transition:enter-start="opacity-0 -translate-x-4"
                      x-transition:enter-end="opacity-100 translate-x-0"
                      class="whitespace-nowrap">Logout</span>
            </button>
        </form>
    </div>
</div>
