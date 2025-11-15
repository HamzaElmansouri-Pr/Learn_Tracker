@extends('layouts.app')

@section('title', 'Create Exam Module')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 bg-clip-text text-transparent mb-2">
            ✨ Create Exam Module
        </h1>
        <p class="text-lg text-gray-600">Add a new exam and generate a study schedule 🎯</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8 border-l-4 border-orange-500">
        <form method="POST" action="{{ route('exams.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="module_name" class="block text-sm font-bold text-gray-700 mb-2">
                    📝 Module Name *
                </label>
                <input type="text" name="module_name" id="module_name" required 
                    class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all @error('module_name') border-red-500 @enderror" 
                    value="{{ old('module_name') }}" placeholder="e.g., Mathematics Final Exam">
                @error('module_name')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <span class="mr-1">⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="exam_date" class="block text-sm font-bold text-gray-700 mb-2">
                    📅 Exam Date *
                </label>
                <input type="date" name="exam_date" id="exam_date" required min="{{ date('Y-m-d') }}"
                    class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all @error('exam_date') border-red-500 @enderror" 
                    value="{{ old('exam_date') }}">
                @error('exam_date')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <span class="mr-1">⚠️</span> {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-gray-500 flex items-center">
                    <span class="mr-1">💡</span> A study schedule will be automatically generated based on the exam date and time required.
                </p>
            </div>

            <div>
                <label for="time_required" class="block text-sm font-bold text-gray-700 mb-2">
                    ⏰ Time Required (Hours) *
                </label>
                <input type="number" name="time_required" id="time_required" required min="1" 
                    class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all @error('time_required') border-red-500 @enderror" 
                    value="{{ old('time_required') }}" placeholder="e.g., 20">
                @error('time_required')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <span class="mr-1">⚠️</span> {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-gray-500 flex items-center">
                    <span class="mr-1">💡</span> Total hours needed for preparation
                </p>
            </div>

            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-xl p-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <span class="text-3xl">💡</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-blue-900">Study Schedule</h3>
                        <div class="mt-2 text-sm text-blue-800">
                            <p>After creating this exam module, a study schedule will be automatically generated with suggested study sessions leading up to the exam date. 📚</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('exams.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl font-semibold transition-all">
                    Cancel
                </a>
                <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    ✨ Create Exam Module
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
