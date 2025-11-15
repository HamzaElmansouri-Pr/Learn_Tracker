<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'learning_item_id',
        'exam_module_id',
        'scheduled_date',
        'scheduled_time',
        'duration',
        'is_completed',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'scheduled_time' => 'datetime',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function learningItem()
    {
        return $this->belongsTo(LearningItem::class);
    }

    public function examModule()
    {
        return $this->belongsTo(ExamModule::class);
    }

    public function markAsCompleted()
    {
        $this->update([
            'is_completed' => true,
            'completed_at' => now(),
        ]);
    }
}

