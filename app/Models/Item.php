<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


#[Fillable(['nom'])]
class Item extends Model
{
    use HasFactory;
    
    // mise en place relation many-to-many
    public function services():BelongsToMany{
        return $this->belongsToMany(Service::class)->withPivot('prix_applique');
    }
}
