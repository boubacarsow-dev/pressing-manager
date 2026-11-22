<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['order_id', 'item_id', 'service_id', 'quantite', 'prix_unitaire'])]

class OrderItem extends Model
{
    use HasFactory;

    public function order(): BelongsTo{
        return $this->belongsTo(Order::class);
    }

    public function item(): BelongsTo{
        return $this->belongsTo(Item::class);
    }

    public function service(): BelongsTo{
        return $this->belongsTo(Service::class);
    }
}