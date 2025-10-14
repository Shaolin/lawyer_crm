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
        'last_notified_at',
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

    // Interval in hours for notifications per priority
    public function intervalPerPriority(): int
    {
        return match($this->priority) {
            'high' => 6,     // 6 hours between SMS
            'medium' => 24,  // 24 hours
            'low' => 168,    // 1 week
            default => 24,
        };
    }

    // Check if we should send a notification
    public function shouldNotify(): bool
    {
        if (!$this->last_notified_at) {
            return true; // never notified
        }

        $hoursBetween = $this->intervalPerPriority();

        return $this->last_notified_at->diffInHours(now()) >= $hoursBetween;
    }
}
