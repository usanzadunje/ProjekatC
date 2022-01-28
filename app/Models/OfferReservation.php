<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OfferReservation extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'offer_id',
        'reservation_id',
        'created_at',
        'updated_at',
    ];

    public function offer(): BelongsTo {
        return $this->belongsTo(Offer::class);
    }

    public function reservation(): BelongsTo {
        return $this->belongsTo(Reservation::class);
    }
}
