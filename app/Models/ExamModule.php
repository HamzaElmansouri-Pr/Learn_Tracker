<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ExamModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module_name',
        'exam_date',
        'time_required',
        'is_completed',
    ];

    protected $casts = [
        'exam_date' => 'date',
        'is_completed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studySessions()
    {
        return $this->hasMany(LearningSession::class);
    }

    public function isUrgent()
    {
        return $this->exam_date->isBefore(now()->addDays(7));
    }

    public function daysUntilExam()
    {
        return now()->diffInDays($this->exam_date, false);
    }

    public function generateStudySchedule()
    {
        $daysUntilExam = $this->daysUntilExam();
        $totalHours = $this->time_required;
        
        if ($daysUntilExam <= 0) {
            return [];
        }

        $sessions = [];
        $hoursPerDay = ceil($totalHours / max($daysUntilExam, 1));
        $currentDate = now()->startOfDay();

        for ($i = 0; $i < $daysUntilExam && $totalHours > 0; $i++) {
            $hoursForDay = min($hoursPerDay, $totalHours);
            $sessions[] = [
                'date' => $currentDate->copy()->addDays($i)->format('Y-m-d'),
                'hours' => $hoursForDay,
                'is_urgent' => $i < 3,
            ];
            $totalHours -= $hoursForDay;
        }

        return $sessions;
    }
}

