<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogbookSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id','title','pdf_path','status','officer_id','review_comment','submitted_at','reviewed_at'
    ];

    protected $dates = ['submitted_at','reviewed_at'];

    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function officer() { return $this->belongsTo(User::class, 'officer_id'); }
}
