<?php

namespace App\Models;

use App\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bien extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }
}
