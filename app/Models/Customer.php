<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
#[Fillable(['nom', 'tel', 'adresse'])]
class Customer extends Model
{
    use HasFactory;
    
    // mise en place de la relation one-to-many
    public function orders():HasMany{
        return $this->hasMany(Order::class);
    }
    
}
