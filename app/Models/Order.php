<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['ref','livraison_prev', 'date_depot','date_recup','statut','montant_total','customer_id'])]
class Order extends Model
{
    use HasFactory;
    // mise en place de la relation: une commande concerne(appartient) a un client
    public function customer():BelongsTo{
        return $this->belongsTo(Customer::class);
    }

    public function payments():HasMany{
        return $this->hasMany(Payment::class);
    }

     public function orderItems(): HasMany{
    return $this->hasMany(OrderItem::class);
     }

    public function orderIsPaid():bool{
        return $this->payments->sum('montant') >= $this->montant_total;
    }
}
