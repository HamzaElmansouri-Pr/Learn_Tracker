@extends('layouts.app')

@section('title', 'Learning Items')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent">
                📖 Learning Items
            </h1>
            <p class="mt-2 text-gray-600 text-lg">Manage your learning goals and track progress ✨</p>
        </div>
        <a href="{{ route('learning-items.create') }}" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
            ✨ Add New Item
        </a>
    </div>

    @if($learningItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($learningItems as $item)
                <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 {{ $item->is_completed ? 'border-green-500 opacity-75' : ($item->priority === 'high' ? 'border-red-500' : ($item->priority === 'medium' ? 'border-yellow-500' : 'border-blue-500')) }}">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-gray-900 flex-1 pr-2">{{ $item->title }}</h3>
                        <form method="POST" action="{{ route('learning-items.toggle-complete', $item) }}" class="ml-2">
                            @csrf
                            <button type="submit" class="text-3xl transform hover:scale-125 transition-transform">
                                {!! $item->is_completed ? '✅' : '⭕' !!}
                            </button>
                        </form>
                    </div>
                    
                    @if($item->description)
                        <p class="text-gray-600 mb-4 line-clamp-2 text-sm">{{ $item->description }}</p>
                    @endif

                    <div class="space-y-3 mb-4">
                        @if($item->target_date)
                            <div class="flex items-center text-sm text-gray-600 bg-purple-50 px-3 py-2 rounded-lg">
                                <span class="mr-2">📅</span>
                                <span class="font-medium">{{ $item->target_date->format('M d, Y') }}</span>
                            </div>
                        @endif

                        <div class="flex items-center justify-between">
                            <span class="px-4 py-2 text-xs font-bold rounded-full 
                                {{ $item->priority === 'high' ? 'bg-gradient-to-r from-red-100 to-pink-100 text-red-800' : ($item->priority === 'medium' ? 'bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800' : 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800') }}">
                                {{ ucfirst($item->priority) }} Priority
                            </span>
                            @if($item->is_completed)
                                <span class="px-4 py-2 text-xs font-bold rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800">
                                    ✅ Completed
                                </span>
                            @endif
                        </div>
                    </div>

                    @if(!empty($item->links) && is_array($item->links) && count($item->links) > 0)
                        <div class="mb-4 bg-blue-50 rounded-lg p-3">
                            <p class="text-xs font-semibold text-gray-700 mb-2">🔗 Resources:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($item->links, 0, 3) as $link)
                                    <a href="{{ $link }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 truncate max-w-xs bg-white px-2 py-1 rounded">
                                        🔗 Link
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('learning-items.show', $item) }}" class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-4 py-2 rounded-xl text-center text-sm font-semibold shadow-md hover:shadow-lg transition-all">
                            👁️ View
                        </a>
                        <a href="{{ route('learning-items.edit', $item) }}" class="flex-1 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl text-center text-sm font-semibold shadow-md hover:shadow-lg transition-all">
                            ✏️ Edit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
            <div class="text-8xl mb-6 float-animation">📚</div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No learning items yet</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first learning item! 🚀</p>
            <a href="{{ route('learning-items.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-lg text-base font-bold rounded-xl text-white bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-600 hover:via-purple-600 hover:to-pink-600 transition-all duration-200 transform hover:scale-105">
                ✨ Add Learning Item
            </a>
        </div>
    @endif
</div>
@endsection
