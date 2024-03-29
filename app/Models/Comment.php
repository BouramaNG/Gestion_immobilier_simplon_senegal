<?php

namespace App\Models;

use App\Models\User;
use App\Models\Propertie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }
}
