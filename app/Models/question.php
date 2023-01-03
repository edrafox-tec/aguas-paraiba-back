<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class question extends Model
{
    use HasFactory; 
    use SoftDeletes;
    public $table = 'questions';
    protected $fillable = [
        'question',
        'answerType',
        'description',
        'id_formTheme',
    ];
}
