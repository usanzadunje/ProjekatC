<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Offer extends Model
{
    use HasFactory;

    public function place(): BelongsTo {
        return $this->belongsTo(Place::class);
    }

    public function reservations(): BelongsToMany {
        return $this
            ->belongsToMany(
                Reservation::class, 'offer_reservation',
                'offer_id', 'reservation_id',
            )
            ->using(OfferReservation::class)
            ->as('requests')
            ->withPivot('id', 'additional_requirements');
    }
}
