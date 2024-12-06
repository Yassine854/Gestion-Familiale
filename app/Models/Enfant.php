<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{
    protected $table = 'enfants';

    use HasFactory;
    
    protected $fillable = [
        'name',
        'last_name',
        'birthday',
        'gender',
        'parent_id',
        
    ];
    
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function reseauxSociaux()
    {
        return $this->hasMany(Reseaux::class, 'enfant_id'); 
    }
}
