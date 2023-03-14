<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assing extends Model
{
    use HasFactory;
    public $table = 'assings';
    protected $fillable = [
        'user',
        'user_id',
        'postworkAnswer',
        'signed',
        'level_user',
        'id',
    ];
    public function form()
    {
        return $this->hasMany(postWork::class, 'id', 'postworkAnswer')->with('form');
    }
}
