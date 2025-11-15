@extends('layouts.app')

@section('title', 'Statistics')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
            📊 Statistics
        </h1>
        <p class="text-lg text-gray-600">Track your learning progress and performance ✨</p>
    </div>

    <!-- Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 border-indigo-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Completion Rate</p>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $completionRate }}%</p>
                </div>
                <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center float-animation">
                    <span class="text-3xl">📈</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Sessions This Week</p>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $sessionsThisWeek }}/{{ $totalSessionsThisWeek }}</p>
                </div>
                <div class="w-16 h-16 rounded-full gradient-bg-4 flex items-center justify-center float-animation" style="animation-delay: 0.2s">
                    <span class="text-3xl">✅</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Session Completion</p>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $sessionCompletionRate }}%</p>
                </div>
                <div class="w-16 h-16 rounded-full gradient-bg-2 flex items-center justify-center float-animation" style="animation-delay: 0.4s">
                    <span class="text-3xl">🎯</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">High Priority Pending</p>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $priorityStats['high'] }}</p>
                </div>
                <div class="w-16 h-16 rounded-full gradient-bg-2 flex items-center justify-center float-animation" style="animation-delay: 0.6s">
                    <span class="text-3xl">🚨</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Priority Breakdown -->
    <div class="bg-white rounded-2xl shadow-xl mb-8 overflow-hidden">
        <div class="gradient-bg p-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <span class="mr-2">⚡</span> Priority Breakdown
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-8 bg-gradient-to-br from-red-50 to-pink-50 rounded-xl border-2 border-red-200 hover-lift">
                    <div class="text-5xl font-bold text-red-600 mb-2">{{ $priorityStats['high'] }}</div>
                    <div class="text-lg font-semibold text-gray-700">🔴 High Priority</div>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl border-2 border-yellow-200 hover-lift">
                    <div class="text-5xl font-bold text-yellow-600 mb-2">{{ $priorityStats['medium'] }}</div>
                    <div class="text-lg font-semibold text-gray-700">🟡 Medium Priority</div>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border-2 border-green-200 hover-lift">
                    <div class="text-5xl font-bold text-green-600 mb-2">{{ $priorityStats['low'] }}</div>
                    <div class="text-lg font-semibold text-gray-700">🟢 Low Priority</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Weekly Statistics -->
    <div class="bg-white rounded-2xl shadow-xl mb-8 overflow-hidden">
        <div class="gradient-bg-3 p-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <span class="mr-2">📅</span> Weekly Progress (Last 12 Weeks)
            </h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-cyan-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Week</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Completed</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($weeklyStats as $week)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $week['week'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $week['created'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800">
                                        {{ $week['completed'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Monthly Statistics -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="gradient-bg-2 p-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <span class="mr-2">📆</span> Monthly Progress (Last 12 Months)
            </h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-pink-50 to-red-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Month</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Completed</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($monthlyStats as $month)
                            <tr class="hover:bg-pink-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $month['month'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $month['created'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800">
                                        {{ $month['completed'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
