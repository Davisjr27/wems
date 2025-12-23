<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogbookSummary extends Model
{
    protected $fillable = [
        'student_id',
        'officer_id',
        'summary',
        'status',
        'rejection_reason',
        'reviewed_at',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }
}
