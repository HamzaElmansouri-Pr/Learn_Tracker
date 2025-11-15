<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Learning Tracker')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-bg-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .gradient-bg-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .gradient-bg-4 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        .gradient-bg-5 {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .magic-border {
            position: relative;
            background: white;
        }
        .magic-border::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 2px;
            background: linear-gradient(135deg, #667eea, #764ba2, #f093fb, #f5576c);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50 min-h-screen">
    @auth
    <nav class="bg-white/80 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent">
                            ✨ Learning Tracker
                        </h1>
                    </div>
                    <div class="hidden sm:ml-8 sm:flex sm:space-x-4">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-lg shadow-purple-500/50' : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }}">
                            🏠 Dashboard
                        </a>
                        <a href="{{ route('learning-items.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('learning-items.*') ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/50' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                            📖 Learning Items
                        </a>
                        <a href="{{ route('exams.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('exams.*') ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg shadow-orange-500/50' : 'text-gray-700 hover:bg-orange-50 hover:text-orange-600' }}">
                            📝 Exams
                        </a>
                        <a href="{{ route('calendar.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('calendar.*') ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-lg shadow-green-500/50' : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                            📅 Calendar
                        </a>
                        <a href="{{ route('statistics.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('statistics.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/50' : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-600' }}">
                            📊 Statistics
                        </a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <div class="flex items-center space-x-2 bg-gradient-to-r from-purple-100 to-pink-100 px-4 py-2 rounded-full">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-lg shadow-red-500/50 transition-all duration-200 hover:shadow-xl">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main class="py-6">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4 animate-pulse">
                <div class="bg-gradient-to-r from-green-400 to-emerald-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center space-x-3" role="alert">
                    <span class="text-2xl">✅</span>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                <div class="bg-gradient-to-r from-red-400 to-pink-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center space-x-3" role="alert">
                    <span class="text-2xl">❌</span>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>

