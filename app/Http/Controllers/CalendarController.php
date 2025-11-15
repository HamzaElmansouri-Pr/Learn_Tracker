<?php

namespace App\Http\Controllers;

use App\Models\LearningItem;
use App\Models\ExamModule;
use App\Models\LearningSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events(Request $request)
    {
        $user = Auth::user();
        $start = $request->input('start');
        $end = $request->input('end');

        $events = [];

        // Learning items
        $learningItems = LearningItem::where('user_id', $user->id)
            ->where(function($query) use ($start, $end) {
                if ($start && $end) {
                    $query->whereBetween('target_date', [$start, $end])
                        ->orWhereNull('target_date');
                }
            })
            ->get();

        foreach ($learningItems as $item) {
            if ($item->target_date) {
                $events[] = [
                    'id' => 'item_' . $item->id,
                    'title' => $item->title,
                    'start' => $item->target_date->format('Y-m-d'),
                    'color' => $item->is_completed ? '#10b981' : ($item->priority === 'high' ? '#ef4444' : '#3b82f6'),
                    'type' => 'learning_item',
                    'item_id' => $item->id,
                ];
            }
        }

        // Exam modules
        $examModules = ExamModule::where('user_id', $user->id)
            ->where(function($query) use ($start, $end) {
                if ($start && $end) {
                    $query->whereBetween('exam_date', [$start, $end]);
                }
            })
            ->get();

        foreach ($examModules as $exam) {
            $events[] = [
                'id' => 'exam_' . $exam->id,
                'title' => $exam->module_name . ' (Exam)',
                'start' => $exam->exam_date->format('Y-m-d'),
                'color' => $exam->isUrgent() ? '#dc2626' : '#f59e0b',
                'type' => 'exam',
                'item_id' => $exam->id,
            ];
        }

        // Learning sessions
        $sessions = LearningSession::where('user_id', $user->id)
            ->where(function($query) use ($start, $end) {
                if ($start && $end) {
                    $query->whereBetween('scheduled_date', [$start, $end]);
                }
            })
            ->with(['learningItem', 'examModule'])
            ->get();

        foreach ($sessions as $session) {
            $title = 'Study Session';
            if ($session->learningItem) {
                $title = $session->learningItem->title;
            } elseif ($session->examModule) {
                $title = $session->examModule->module_name . ' Study';
            }

            $events[] = [
                'id' => 'session_' . $session->id,
                'title' => $title,
                'start' => $session->scheduled_date->format('Y-m-d') . 'T' . 
                          Carbon::parse($session->scheduled_time)->format('H:i:s'),
                'end' => $session->scheduled_date->format('Y-m-d') . 'T' . 
                        Carbon::parse($session->scheduled_time)->addMinutes($session->duration)->format('H:i:s'),
                'color' => $session->is_completed ? '#10b981' : '#8b5cf6',
                'type' => 'session',
                'item_id' => $session->id,
            ];
        }

        return response()->json($events);
    }

    public function updateSession(Request $request, LearningSession $session)
    {
        $this->authorize('update', $session);

        $validated = $request->validate([
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
            'duration' => 'required|integer|min:15',
        ]);

        $session->update([
            'scheduled_date' => $validated['scheduled_date'],
            'scheduled_time' => Carbon::parse($validated['scheduled_date'] . ' ' . $validated['scheduled_time']),
            'duration' => $validated['duration'],
        ]);

        return response()->json(['success' => true]);
    }
}

