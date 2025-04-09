<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if(Session::has('toast'))
        <meta name="toast-data" content="{{ json_encode(Session::get('toast')) }}">
    @endif

    <title>{{ config('app.name', 'Loan Management System') }}</title>

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#4f46e5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="LoanMS">
    <link rel="apple-touch-icon" href="/icons/icon-152x152.png">
    <link rel="manifest" href="/manifest.json">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/toast.js'])
    <script src="{{ asset('js/pwa.js') }}" defer></script>
</head>
<body class="h-full bg-gray-100">
    <div x-data="{ sidebarCollapsed: false }"
         @sidebar-toggle.window="sidebarCollapsed = $event.detail">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')
        
        <!-- Main Content -->
        <main :class="{ 'ml-64': !sidebarCollapsed, 'ml-16': sidebarCollapsed }"
              class="ml-64 transition-all duration-200 p-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>