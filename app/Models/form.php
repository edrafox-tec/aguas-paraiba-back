<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\formTheme;
use App\Models\postWorkAnswer;
class form extends Model
{
    use HasFactory; 
    use SoftDeletes;
    public $table = 'forms';
    protected $fillable = [
        'name',
        'description',
        'id_sector'
    ];
    public function formThemes(){
        return $this->hasMany(formTheme::class, 'id_form')->with('questions');
    }
    public function postWorkAnswer(){
        return $this->hasMany(formTheme::class, 'id_form')->with('answer');
    }
}
