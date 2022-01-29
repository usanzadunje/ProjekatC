<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Offer
 *
 * @property int $id
 * @property string $name
 * @property int $place_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Place $place
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @method static \Database\Factories\OfferFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Offer extends Model
{
    use HasFactory;

    protected $hidden = [
        'place_id',
        'created_at',
        'updated_at',
    ];

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
