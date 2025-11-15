@extends('layouts.app')

@section('title', 'Exam Modules')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 bg-clip-text text-transparent">
                📝 Exam Modules
            </h1>
            <p class="mt-2 text-gray-600 text-lg">Manage your exam preparation and study schedules 🎯</p>
        </div>
        <a href="{{ route('exams.create') }}" class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
            ✨ Add New Exam
        </a>
    </div>

    @if($examModules->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($examModules as $exam)
                <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 {{ $exam->isUrgent() ? 'border-red-500 bg-gradient-to-r from-red-50 to-pink-50' : 'border-orange-500' }} {{ $exam->is_completed ? 'opacity-75' : '' }}">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-gray-900 flex-1 pr-2">{{ $exam->module_name }}</h3>
                        @if($exam->isUrgent())
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-red-500 to-pink-500 text-white shadow-lg animate-pulse">
                                🚨 Urgent
                            </span>
                        @endif
                    </div>
                    
                    <div class="space-y-3 mb-4">
                        <div class="flex items-center text-sm text-gray-700 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="mr-2 text-lg">📅</span>
                            <span class="font-semibold">Exam Date:</span>
                            <span class="ml-2 font-bold">{{ $exam->exam_date->format('M d, Y') }}</span>
                        </div>

                        <div class="flex items-center text-sm text-gray-700 bg-purple-50 px-3 py-2 rounded-lg">
                            <span class="mr-2 text-lg">⏰</span>
                            <span class="font-semibold">Time Required:</span>
                            <span class="ml-2 font-bold">{{ $exam->time_required }} hours</span>
                        </div>

                        <div class="flex items-center text-sm text-gray-700 bg-green-50 px-3 py-2 rounded-lg">
                            <span class="mr-2 text-lg">📊</span>
                            <span class="font-semibold">Days Until Exam:</span>
                            <span class="ml-2 font-bold {{ $exam->daysUntilExam() < 7 ? 'text-red-600' : 'text-green-600' }}">
                                {{ $exam->daysUntilExam() }} days
                            </span>
                        </div>

                        @if($exam->is_completed)
                            <span class="inline-block px-4 py-2 text-xs font-bold rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800">
                                ✅ Completed
                            </span>
                        @endif
                    </div>

                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('exams.show', $exam) }}" class="flex-1 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-4 py-2 rounded-xl text-center text-sm font-semibold shadow-md hover:shadow-lg transition-all">
                            📋 Schedule
                        </a>
                        <a href="{{ route('exams.edit', $exam) }}" class="flex-1 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl text-center text-sm font-semibold shadow-md hover:shadow-lg transition-all">
                            ✏️ Edit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
            <div class="text-8xl mb-6 float-animation">📝</div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No exam modules yet</h3>
            <p class="text-gray-500 mb-6">Start preparing for your exams by adding an exam module! 🎓</p>
            <a href="{{ route('exams.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-lg text-base font-bold rounded-xl text-white bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 hover:from-orange-600 hover:via-red-600 hover:to-pink-600 transition-all duration-200 transform hover:scale-105">
                ✨ Add Exam Module
            </a>
        </div>
    @endif
</div>
@endsection
