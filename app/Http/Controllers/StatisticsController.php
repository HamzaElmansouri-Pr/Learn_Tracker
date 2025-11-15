<?php

namespace App\Http\Controllers;

use App\Models\LearningItem;
use App\Models\ExamModule;
use App\Models\LearningSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Weekly statistics
        $weeklyStats = $this->getWeeklyStats($user);
        
        // Monthly statistics
        $monthlyStats = $this->getMonthlyStats($user);
        
        // Overall completion rate
        $totalItems = LearningItem::where('user_id', $user->id)->count();
        $completedItems = LearningItem::where('user_id', $user->id)
            ->where('is_completed', true)
            ->count();
        $completionRate = $totalItems > 0 ? round(($completedItems / $totalItems) * 100, 1) : 0;
        
        // Sessions completed this week
        $sessionsThisWeek = LearningSession::where('user_id', $user->id)
            ->whereBetween('scheduled_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('is_completed', true)
            ->count();
        
        $totalSessionsThisWeek = LearningSession::where('user_id', $user->id)
            ->whereBetween('scheduled_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
        
        $sessionCompletionRate = $totalSessionsThisWeek > 0 
            ? round(($sessionsThisWeek / $totalSessionsThisWeek) * 100, 1) 
            : 0;
        
        // Priority breakdown
        $priorityStats = [
            'high' => LearningItem::where('user_id', $user->id)
                ->where('priority', 'high')
                ->where('is_completed', false)
                ->count(),
            'medium' => LearningItem::where('user_id', $user->id)
                ->where('priority', 'medium')
                ->where('is_completed', false)
                ->count(),
            'low' => LearningItem::where('user_id', $user->id)
                ->where('priority', 'low')
                ->where('is_completed', false)
                ->count(),
        ];
        
        return view('statistics.index', compact(
            'weeklyStats',
            'monthlyStats',
            'completionRate',
            'sessionsThisWeek',
            'totalSessionsThisWeek',
            'sessionCompletionRate',
            'priorityStats'
        ));
    }

    private function getWeeklyStats($user)
    {
        $weeks = [];
        for ($i = 11; $i >= 0; $i--) {
            $weekStart = now()->subWeeks($i)->startOfWeek();
            $weekEnd = now()->subWeeks($i)->endOfWeek();
            
            $completed = LearningItem::where('user_id', $user->id)
                ->where('is_completed', true)
                ->whereBetween('completed_at', [$weekStart, $weekEnd])
                ->count();
            
            $created = LearningItem::where('user_id', $user->id)
                ->whereBetween('created_at', [$weekStart, $weekEnd])
                ->count();
            
            $weeks[] = [
                'week' => $weekStart->format('M d'),
                'completed' => $completed,
                'created' => $created,
            ];
        }
        
        return $weeks;
    }

    private function getMonthlyStats($user)
    {
        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();
            
            $completed = LearningItem::where('user_id', $user->id)
                ->where('is_completed', true)
                ->whereBetween('completed_at', [$monthStart, $monthEnd])
                ->count();
            
            $created = LearningItem::where('user_id', $user->id)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
            
            $months[] = [
                'month' => $monthStart->format('M Y'),
                'completed' => $completed,
                'created' => $created,
            ];
        }
        
        return $months;
    }
}

