<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    protected $fillable = ['form_id','title','description'];
    public function form() {
        return $this->belongsTo(EvaluationForm::class);
    }
}
