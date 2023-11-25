<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;
    public function images()
    {
        return $this->hasMany(Multi_img::class, 'chambre_id');
    }
}
