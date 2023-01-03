<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class formTheme extends Model
{
    use HasFactory; 
    use SoftDeletes;
    public $table = 'formThemes';
    protected $fillable = [
        'theme',
        'description',
        'id_form',
    ];
}
