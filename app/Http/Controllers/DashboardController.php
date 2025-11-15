<?php

namespace App\Http\Controllers;

use App\Models\LearningItem;
use App\Models\ExamModule;
use App\Models\LearningSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalLearningItems = LearningItem::where('user_id', $user->id)->count();
        $completedItems = LearningItem::where('user_id', $user->id)
            ->where('is_completed', true)
            ->count();
        $pendingItems = $totalLearningItems - $completedItems;
        
        $upcomingExams = ExamModule::where('user_id', $user->id)
            ->where('is_completed', false)
            ->where('exam_date', '>=', now())
            ->orderBy('exam_date', 'asc')
            ->limit(5)
            ->get();
        
        $urgentExams = ExamModule::where('user_id', $user->id)
            ->where('is_completed', false)
            ->where('exam_date', '<=', now()->addDays(7))
            ->where('exam_date', '>=', now())
            ->get();
        
        $todaySessions = LearningSession::where('user_id', $user->id)
            ->where('scheduled_date', today())
            ->where('is_completed', false)
            ->orderBy('scheduled_time', 'asc')
            ->get();
        
        $thisWeekSessions = LearningSession::where('user_id', $user->id)
            ->whereBetween('scheduled_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('is_completed', false)
            ->count();
        
        $completionRate = $totalLearningItems > 0 
            ? round(($completedItems / $totalLearningItems) * 100, 1) 
            : 0;
        
        $recentItems = LearningItem::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard', compact(
            'totalLearningItems',
            'completedItems',
            'pendingItems',
            'upcomingExams',
            'urgentExams',
            'todaySessions',
            'thisWeekSessions',
            'completionRate',
            'recentItems'
        ));
    }
}

