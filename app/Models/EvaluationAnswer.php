<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationAnswer extends Model
{
    protected $fillable = ['question_id','user_id','target_user_id','score','comment'];

    public function evaluator() {
        return $this->belongsTo(User::class,'user_id');
    }
    public function target() {
        return $this->belongsTo(User::class,'target_user_id');
    }
    public function question() {
        return $this->belongsTo(EvaluationQuestion::class,'question_id');
    }
}
