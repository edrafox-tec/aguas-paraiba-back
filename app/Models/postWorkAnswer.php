<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class postWorkAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'postWorkAnswers';
    protected $fillable = [
        'answer',
        'id_postWork',
        'id_question',
        'id_answer',
    ];
}
