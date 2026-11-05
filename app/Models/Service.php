<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['description','libelle','tarif','actif'])]
class Service extends Model
{
    use HasFactory;
    // mise en place relation many-to-many
    public function items():BelongsToMany{
        return $this->belongsToMany(Item::class)->withPivot('prix_applique');
    }
}
