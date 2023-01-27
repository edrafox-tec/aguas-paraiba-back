<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class postWorkAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'post_work_answers';
    protected $fillable = [
        'id',
        'id_postWork',
        'form_array',
        'conformity'
    ];
}
