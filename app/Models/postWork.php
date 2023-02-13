<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class postWork extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'post_works';
    protected $fillable = [
        'id_sector',
        'id_form',
        'id_user',
        'conformity',
        'observation'
    ];
    public function postWorkAnswer()
    {
        return $this->hasMany(postWorkAnswer::class, 'id_postWork');
    }
    public function form()
    {
        return $this->hasMany(form::class, 'id', 'id_form');
    }
}
