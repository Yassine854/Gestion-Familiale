<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseaux extends Model
{
    use HasFactory;
    protected $table = 'reseau_socials';

    protected $fillable = [
        'name',
        'url',
        'enfant_id'
    ];
    
    public function enfant()
    {
        return $this->belongsTo(Enfant::class, 'enfant_id');
    }
}
