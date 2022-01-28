<?php

namespace App\Models;

use App\Traits\Excludable;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\Reservation
 *
 * @property int $id
 * @property int $user_id
 * @property int $place_id
 * @property \Illuminate\Support\Carbon|null $reservation_date
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Place $place
 * @property-read \App\Models\User $reservee
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation exclude(array|string $excludedColumns)
 * @method static \Database\Factories\ReservationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereReservationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUserId($value)
 * @mixin \Eloquent
 */
class Reservation extends Pivot
{
    use HasFactory, Excludable, Filterable;

    /**
     * Indicates which table is being used for model.
     *
     * @var string
     */
    protected $table = 'reservations';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reservation_date' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
        'place_id',
        'updated_at',
    ];

    public function reservee(): BelongsTo {
        return $this
            ->belongsTo(User::class, 'user_id', 'id', 'users')
            ->select('id', 'first_name', 'last_name', 'email');
    }

    public function place(): BelongsTo {
        return $this->belongsTo(Place::class)
            ->select('id', 'name', 'address');
    }

    public function offers(): BelongsToMany {
        return $this
            ->belongsToMany(
                Offer::class, 'offer_reservation',
                'reservation_id','offer_id',
            )
            ->using(OfferReservation::class)
            ->as('requests')
            ->withPivot('id', 'additional_requirements');
    }
}
