<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'week',
        'start_date',
        'end_date',
        'activities',
        'company_stamp', // required
        'work_image',    // optional
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
