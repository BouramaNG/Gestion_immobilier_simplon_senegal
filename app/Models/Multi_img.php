<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multi_img extends Model
{
    use HasFactory;
    protected $fillable = ['propertie_id', 'photo_name','chambre_id'];
    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }
}
