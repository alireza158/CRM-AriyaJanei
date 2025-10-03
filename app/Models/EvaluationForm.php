<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    protected $fillable = ['title','evaluator_role','target_role','unit_id'];

    public function questions() {
        return $this->hasMany(EvaluationQuestion::class,'form_id');
    }
}
