<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'links',
        'target_date',
        'week',
        'day',
        'time',
        'is_completed',
        'completed_at',
        'priority',
    ];

    protected $casts = [
        'target_date' => 'date',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
        'links' => 'array',
    ];

    public function getLinksAttribute($value)
    {
        // If value is already an array (from cast), return it
        if (is_array($value)) {
            return $value;
        }
        
        // If null or empty, return empty array
        if (is_null($value) || $value === '' || $value === 'null') {
            return [];
        }
        
        // If it's a JSON string, decode it
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        
        // Fallback to empty array
        return [];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function learningSessions()
    {
        return $this->hasMany(LearningSession::class);
    }

    public function markAsCompleted()
    {
        $this->update([
            'is_completed' => true,
            'completed_at' => now(),
        ]);
    }

    public function markAsIncomplete()
    {
        $this->update([
            'is_completed' => false,
            'completed_at' => null,
        ]);
    }
}

