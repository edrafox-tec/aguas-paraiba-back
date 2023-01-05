<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class formTheme extends Model
{
    use HasFactory; 
    use SoftDeletes;
    public $table = 'form_themes';
    protected $fillable = [
        'theme',
        'description',
        'id_form',
    ];
    public function questions(){
        return $this->hasMany(question::class, 'id_formTheme')->with('answers');
    }
}
