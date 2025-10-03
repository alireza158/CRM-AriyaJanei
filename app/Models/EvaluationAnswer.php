<?php
// app/Models/EvaluationAnswer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
        'target_user_id',
        'score',
        'comment',
    ];

    // کسی که ارزیابی کرده
    public function evaluator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // کسی که ارزیابی شده
    public function target()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }

    // سوال مربوطه
    public function question()
    {
        return $this->belongsTo(EvaluationQuestion::class, 'question_id');
    }
}
