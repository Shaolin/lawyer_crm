<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    
   
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'type',
        'priority',
        'user_id',
        'legal_case_id',
        'project_id',
        'organization_id',
    ];
    
   
   
    

    

    protected $casts = [
        'due_date' => 'datetime',
        'last_notified_at' => 'datetime',
    ];
    

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function legalCase()
    {
        return $this->belongsTo(LegalCase::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // In Task model
public function notificationFrequency()
{
    return match($this->priority) {
        'high' => 2,    // 2 messages per day
        'medium' => 1,  // 1 message per day
        'low' => 0.14,  // ~1 message per week (1/7 per day)
        default => 1,
    };
}

// In Task.php
public function shouldNotify(): bool
{
    if (!$this->last_notified_at) {
        return true;
    }

    $frequencyPerDay = $this->notificationFrequency(); // 2/day, 1/day, 1/week

    // Convert frequency per day to minimum hours between notifications
    $hoursBetween = 24 / $frequencyPerDay;

    return $this->last_notified_at->diffInHours(now()) >= $hoursBetween;
}


    
}

