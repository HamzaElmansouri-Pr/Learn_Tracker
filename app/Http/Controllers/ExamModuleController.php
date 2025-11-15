<?php

namespace App\Http\Controllers;

use App\Models\ExamModule;
use App\Models\LearningSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExamModuleController extends Controller
{
    public function index()
    {
        $examModules = ExamModule::where('user_id', Auth::id())
            ->orderBy('exam_date', 'asc')
            ->get();
        
        return view('exams.index', compact('examModules'));
    }

    public function create()
    {
        return view('exams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_name' => 'required|string|max:255',
            'exam_date' => 'required|date|after_or_equal:today',
            'time_required' => 'required|integer|min:1',
        ]);

        $examModule = ExamModule::create([
            'user_id' => Auth::id(),
            'module_name' => $validated['module_name'],
            'exam_date' => $validated['exam_date'],
            'time_required' => $validated['time_required'],
        ]);

        // Generate study schedule
        $this->generateStudySchedule($examModule);

        return redirect()->route('exams.index')
            ->with('success', 'Exam module created and study schedule generated!');
    }

    public function show($id)
    {
        $examModule = ExamModule::findOrFail($id);
        
        // Check if exam module belongs to current user
        if ($examModule->user_id !== Auth::id()) {
            abort(403, 'This action is unauthorized.');
        }
        
        $studySchedule = $examModule->generateStudySchedule();
        $sessions = LearningSession::where('exam_module_id', $examModule->id)
            ->orderBy('scheduled_date', 'asc')
            ->orderBy('scheduled_time', 'asc')
            ->get();
        
        return view('exams.show', compact('examModule', 'studySchedule', 'sessions'));
    }

    public function edit($id)
    {
        $examModule = ExamModule::findOrFail($id);
        $this->authorize('update', $examModule);
        return view('exams.edit', compact('examModule'));
    }

    public function update(Request $request, $id)
    {
        $examModule = ExamModule::findOrFail($id);
        $this->authorize('update', $examModule);

        $validated = $request->validate([
            'module_name' => 'required|string|max:255',
            'exam_date' => 'required|date|after_or_equal:today',
            'time_required' => 'required|integer|min:1',
        ]);

        $examModule->update($validated);

        // Regenerate study schedule
        LearningSession::where('exam_module_id', $examModule->id)->delete();
        $this->generateStudySchedule($examModule);

        return redirect()->route('exams.index')
            ->with('success', 'Exam module updated and study schedule regenerated!');
    }

    public function destroy($id)
    {
        $examModule = ExamModule::findOrFail($id);
        $this->authorize('delete', $examModule);
        $examModule->delete();
        return redirect()->route('exams.index')
            ->with('success', 'Exam module deleted successfully!');
    }

    public function toggleComplete($id)
    {
        $examModule = ExamModule::findOrFail($id);
        $this->authorize('update', $examModule);
        
        $examModule->update([
            'is_completed' => !$examModule->is_completed,
        ]);

        $message = $examModule->is_completed 
            ? 'Exam module marked as completed!' 
            : 'Exam module marked as incomplete.';

        return redirect()->back()->with('success', $message);
    }

    private function generateStudySchedule(ExamModule $examModule)
    {
        $schedule = $examModule->generateStudySchedule();
        
        foreach ($schedule as $session) {
            LearningSession::create([
                'user_id' => $examModule->user_id,
                'exam_module_id' => $examModule->id,
                'scheduled_date' => $session['date'],
                'scheduled_time' => Carbon::parse($session['date'])->setTime(9, 0),
                'duration' => $session['hours'] * 60,
            ]);
        }
    }
}

