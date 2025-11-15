@extends('layouts.app')

@section('title', $examModule->module_name)

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 bg-clip-text text-transparent">
                {{ $examModule->module_name }}
            </h1>
            <p class="mt-2 text-gray-600 text-lg">Exam Preparation Schedule</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('exams.edit', $examModule) }}" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                ✏️ Edit
            </a>
            <form method="POST" action="{{ route('exams.toggle-complete', $examModule) }}">
                @csrf
                <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-4 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                    {{ $examModule->is_completed ? '↩️ Mark Incomplete' : '✅ Mark Complete' }}
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-blue-500">
            <h3 class="text-sm font-bold text-gray-600 mb-2 flex items-center">
                <span class="mr-2">📅</span> Exam Date
            </h3>
            <p class="text-3xl font-bold text-gray-900">{{ $examModule->exam_date->format('F d, Y') }}</p>
            <p class="text-sm text-gray-500 mt-2">{{ $examModule->daysUntilExam() }} days remaining</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-purple-500">
            <h3 class="text-sm font-bold text-gray-600 mb-2 flex items-center">
                <span class="mr-2">⏰</span> Time Required
            </h3>
            <p class="text-3xl font-bold text-gray-900">{{ $examModule->time_required }} hours</p>
            <p class="text-sm text-gray-500 mt-2">Total preparation time</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 {{ $examModule->isUrgent() ? 'border-red-500 bg-gradient-to-r from-red-50 to-pink-50' : 'border-green-500' }}">
            <h3 class="text-sm font-bold text-gray-600 mb-2 flex items-center">
                <span class="mr-2">📊</span> Status
            </h3>
            @if($examModule->isUrgent())
                <p class="text-3xl font-bold text-red-600">🚨 Urgent</p>
                <p class="text-sm text-red-500 mt-2">Less than 7 days remaining</p>
            @else
                <p class="text-3xl font-bold text-green-600">✅ On Track</p>
                <p class="text-sm text-gray-500 mt-2">Adequate time remaining</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl mb-6 overflow-hidden">
        <div class="gradient-bg-3 p-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <span class="mr-2">📚</span> Generated Study Schedule
            </h2>
            <p class="text-sm text-white/80 mt-1">Suggested study sessions leading up to the exam</p>
        </div>
        <div class="p-6">
            @if(count($studySchedule) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-blue-50 to-cyan-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Hours</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($studySchedule as $session)
                                <tr class="{{ $session['is_urgent'] ? 'bg-gradient-to-r from-red-50 to-pink-50' : 'hover:bg-blue-50' }} transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($session['date'])->format('F d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $session['hours'] }} hours
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($session['is_urgent'])
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-red-500 to-pink-500 text-white">
                                                🚨 Urgent
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800">
                                                📅 Scheduled
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📅</div>
                    <p class="text-gray-500 text-lg">No study schedule available</p>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="gradient-bg-2 p-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <span class="mr-2">📖</span> Study Sessions
            </h2>
        </div>
        <div class="p-6">
            @if($sessions->count() > 0)
                <div class="space-y-4">
                    @foreach($sessions as $session)
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-4 hover-lift border border-purple-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-bold text-gray-900 text-lg">
                                        📅 {{ $session->scheduled_date->format('F d, Y') }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        ⏰ {{ \Carbon\Carbon::parse($session->scheduled_time)->format('g:i A') }} - 
                                        {{ \Carbon\Carbon::parse($session->scheduled_time)->addMinutes($session->duration)->format('g:i A') }}
                                        <span class="ml-2">({{ $session->duration }} minutes)</span>
                                    </p>
                                </div>
                                <div>
                                    @if($session->is_completed)
                                        <span class="px-4 py-2 text-xs font-bold rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800">
                                            ✅ Completed
                                        </span>
                                    @else
                                        <span class="px-4 py-2 text-xs font-bold rounded-full bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800">
                                            ⏳ Pending
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📚</div>
                    <p class="text-gray-500 text-lg">No study sessions scheduled</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
