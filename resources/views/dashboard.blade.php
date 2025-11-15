@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Welcome Header -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-2">
            Welcome back, {{ Auth::user()->name }}! 👋
        </h1>
        <p class="text-lg text-gray-600">Let's make today productive! ✨</p>
    </div>

    <!-- Stats Grid with Magic Colors -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Items</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalLearningItems }}</p>
                </div>
                <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center float-animation">
                    <span class="text-3xl">📚</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Completed</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $completedItems }}</p>
                </div>
                <div class="w-16 h-16 rounded-full gradient-bg-4 flex items-center justify-center float-animation" style="animation-delay: 0.2s">
                    <span class="text-3xl">✅</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Pending</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingItems }}</p>
                </div>
                <div class="w-16 h-16 rounded-full gradient-bg-5 flex items-center justify-center float-animation" style="animation-delay: 0.4s">
                    <span class="text-3xl">⏳</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Progress</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $completionRate }}%</p>
                </div>
                <div class="w-16 h-16 rounded-full gradient-bg-3 flex items-center justify-center float-animation" style="animation-delay: 0.6s">
                    <span class="text-3xl">📊</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Today's Sessions -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="gradient-bg-3 p-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <span class="mr-2">📅</span> Today's Learning Sessions
                </h2>
            </div>
            <div class="p-6">
                @if($todaySessions->count() > 0)
                    <div class="space-y-4">
                        @foreach($todaySessions as $session)
                            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-4 hover-lift border border-purple-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900">
                                            @if($session->learningItem)
                                                {{ $session->learningItem->title }}
                                            @elseif($session->examModule)
                                                {{ $session->examModule->module_name }} Study
                                            @else
                                                Study Session
                                            @endif
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            ⏰ {{ \Carbon\Carbon::parse($session->scheduled_time)->format('g:i A') }} - 
                                            {{ \Carbon\Carbon::parse($session->scheduled_time)->addMinutes($session->duration)->format('g:i A') }}
                                        </p>
                                    </div>
                                    <span class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full text-sm font-semibold shadow-lg">
                                        {{ $session->duration }} min
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">🎯</div>
                        <p class="text-gray-500 text-lg">No sessions scheduled for today</p>
                        <p class="text-gray-400 text-sm mt-2">Take a break or add a new session!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Urgent Exams -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="gradient-bg-2 p-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <span class="mr-2">🚨</span> Urgent Exams
                </h2>
            </div>
            <div class="p-6">
                @if($urgentExams->count() > 0)
                    <div class="space-y-4">
                        @foreach($urgentExams as $exam)
                            <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-xl p-4 hover-lift border-l-4 border-red-500">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-900 text-lg">{{ $exam->module_name }}</p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            📆 {{ $exam->exam_date->format('M d, Y') }} 
                                            <span class="font-semibold text-red-600">({{ $exam->daysUntilExam() }} days left!)</span>
                                        </p>
                                    </div>
                                    <a href="{{ route('exams.show', $exam) }}" class="ml-4 px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg text-sm font-semibold hover:shadow-lg transition-all">
                                        View →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">🎉</div>
                        <p class="text-gray-500 text-lg">No urgent exams!</p>
                        <p class="text-gray-400 text-sm mt-2">You're all caught up! 🚀</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Learning Items -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="gradient-bg p-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <span class="mr-2">📖</span> Recent Learning Items
            </h2>
            <a href="{{ route('learning-items.create') }}" class="bg-white text-purple-600 px-6 py-2 rounded-lg font-semibold hover:shadow-lg transition-all hover:scale-105">
                + Add New
            </a>
        </div>
        <div class="p-6">
            @if($recentItems->count() > 0)
                <div class="overflow-x-auto">
                    <div class="space-y-3">
                        @foreach($recentItems as $item)
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-4 hover-lift border border-blue-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900 text-lg">{{ $item->title }}</h3>
                                        <div class="flex items-center space-x-4 mt-2">
                                            @if($item->target_date)
                                                <span class="text-sm text-gray-600">📅 {{ $item->target_date->format('M d, Y') }}</span>
                                            @endif
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                                {{ $item->priority === 'high' ? 'bg-red-100 text-red-800' : ($item->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                                {{ ucfirst($item->priority) }}
                                            </span>
                                            @if($item->is_completed)
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    ✅ Completed
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('learning-items.show', $item) }}" class="ml-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg text-sm font-semibold hover:shadow-lg transition-all">
                                        View →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📝</div>
                    <p class="text-gray-500 text-lg">No learning items yet</p>
                    <a href="{{ route('learning-items.create') }}" class="inline-block mt-4 px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg font-semibold hover:shadow-lg transition-all hover:scale-105">
                        Create Your First Item 🚀
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
