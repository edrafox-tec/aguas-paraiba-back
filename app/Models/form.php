<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class form extends Model
{
    use HasFactory; 
    use SoftDeletes;
    public $table = 'forms';
    protected $fillable = [
        'name',
        'description',
    ];
}
