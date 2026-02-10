<?php
// app/Models/EvaluationAnswer.php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmbedToken extends Model
{
    protected $fillable = ['token','name','expires_at','active'];
    protected $casts = ['expires_at' => 'datetime'];
}
