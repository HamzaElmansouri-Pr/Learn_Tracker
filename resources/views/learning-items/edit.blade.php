@extends('layouts.app')

@section('title', 'Edit Learning Item')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-2">
            ✏️ Edit Learning Item
        </h1>
        <p class="text-lg text-gray-600">Update your learning item details 🚀</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8 border-l-4 border-blue-500">
        <form method="POST" action="{{ route('learning-items.update', $learningItem) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
                    📝 Title *
                </label>
                <input type="text" name="title" id="title" required 
                    class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('title') border-red-500 @enderror" 
                    value="{{ old('title', $learningItem->title) }}">
                @error('title')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <span class="mr-1">⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                    📄 Description
                </label>
                <textarea name="description" id="description" rows="4" 
                    class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('description') border-red-500 @enderror">{{ old('description', $learningItem->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <span class="mr-1">⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="links" class="block text-sm font-bold text-gray-700 mb-2">
                    🔗 Links/Resources
                </label>
                <p class="text-xs text-gray-500 mb-2">Enter one link per line</p>
                <textarea name="links" id="links" rows="3" 
                    class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('links') border-red-500 @enderror">{{ old('links', !empty($learningItem->links) && is_array($learningItem->links) ? implode("\n", $learningItem->links) : '') }}</textarea>
                @error('links')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <span class="mr-1">⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="target_date" class="block text-sm font-bold text-gray-700 mb-2">
                        📅 Target Date
                    </label>
                    <input type="date" name="target_date" id="target_date" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('target_date') border-red-500 @enderror" 
                        value="{{ old('target_date', $learningItem->target_date ? $learningItem->target_date->format('Y-m-d') : '') }}">
                    @error('target_date')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <span class="mr-1">⚠️</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-bold text-gray-700 mb-2">
                        ⚡ Priority
                    </label>
                    <select name="priority" id="priority" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="low" {{ old('priority', $learningItem->priority) == 'low' ? 'selected' : '' }}>🟢 Low</option>
                        <option value="medium" {{ old('priority', $learningItem->priority) == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                        <option value="high" {{ old('priority', $learningItem->priority) == 'high' ? 'selected' : '' }}>🔴 High</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="week" class="block text-sm font-bold text-gray-700 mb-2">
                        📆 Week
                    </label>
                    <input type="number" name="week" id="week" min="1" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                        value="{{ old('week', $learningItem->week) }}">
                </div>

                <div>
                    <label for="day" class="block text-sm font-bold text-gray-700 mb-2">
                        📅 Day
                    </label>
                    <input type="text" name="day" id="day" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                        placeholder="Monday" value="{{ old('day', $learningItem->day) }}">
                </div>

                <div>
                    <label for="time" class="block text-sm font-bold text-gray-700 mb-2">
                        ⏰ Time
                    </label>
                    <input type="time" name="time" id="time" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                        value="{{ old('time', $learningItem->time) }}">
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('learning-items.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl font-semibold transition-all">
                    Cancel
                </a>
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    ✨ Update Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
