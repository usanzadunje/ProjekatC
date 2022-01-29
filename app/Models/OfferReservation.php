<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\OfferReservation
 *
 * @property int $id
 * @property int $offer_id
 * @property int $reservation_id
 * @property string|null $additional_requirements
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Offer $offer
 * @property-read \App\Models\Reservation $reservation
 * @method static \Database\Factories\OfferReservationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferReservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferReservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferReservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferReservation whereAdditionalRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferReservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferReservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferReservation whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferReservation whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferReservation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
