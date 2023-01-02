<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sector extends Model
{
    use HasFactory; 
    use SoftDeletes;
    public $table = 'sectors';
    protected $fillable = [
        'name',
        'level',
        'description',
    ];
}
