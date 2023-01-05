<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\formTheme;
class form extends Model
{
    use HasFactory; 
    use SoftDeletes;
    public $table = 'forms';
    protected $fillable = [
        'name',
        'description',
    ];
    public function formThemes(){
        return $this->hasMany(formTheme::class, 'id_form')->with('questions');
    }
}
