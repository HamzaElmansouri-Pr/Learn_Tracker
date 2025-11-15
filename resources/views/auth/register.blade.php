@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Animated Background Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 relative overflow-hidden">
            <!-- Decorative gradient circles -->
            <div class="absolute -top-20 -right-20 w-40 h-40 bg-gradient-to-br from-pink-400 to-red-400 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full opacity-20 blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="text-center mb-8">
                    <div class="text-6xl mb-4 float-animation">🌟</div>
                    <h2 class="text-3xl font-extrabold bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent">
                        Join Us Today!
                    </h2>
                    <p class="mt-2 text-gray-600">Start your learning journey with us</p>
                </div>
                
                <form class="space-y-5" method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            👤 Your Name
                        </label>
                        <input id="name" name="name" type="text" required 
                            class="appearance-none relative block w-full px-4 py-3 border-2 border-gray-200 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror" 
                            placeholder="John Doe" value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <span class="mr-1">⚠️</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            📧 Email Address
                        </label>
                        <input id="email" name="email" type="email" required 
                            class="appearance-none relative block w-full px-4 py-3 border-2 border-gray-200 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror" 
                            placeholder="your@email.com" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <span class="mr-1">⚠️</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            🔒 Password
                        </label>
                        <input id="password" name="password" type="password" required 
                            class="appearance-none relative block w-full px-4 py-3 border-2 border-gray-200 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror" 
                            placeholder="Create a strong password">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <span class="mr-1">⚠️</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            🔒 Confirm Password
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="appearance-none relative block w-full px-4 py-3 border-2 border-gray-200 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all" 
                            placeholder="Confirm your password">
                    </div>

                    <div>
                        <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 hover:from-pink-700 hover:via-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <span class="text-xl">🚀</span>
                            </span>
                            Create Account
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="font-semibold text-pink-600 hover:text-pink-500 transition-colors">
                                Sign in here! ✨
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
