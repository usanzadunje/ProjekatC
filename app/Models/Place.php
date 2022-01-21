<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Place
 *
 * @property int $id
 * @property string $name
 * @property string $city
 * @property string $address
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $reservees
 * @property-read int|null $reservees_count
 * @method static \Database\Factories\PlaceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Place newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Place newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Place query()
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Place filter(string $filter, array $columns)
 */
class Place extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city',
        'address',
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id', 'users');
    }

    public function reservees(): BelongsToMany {
        return $this
            ->belongsToMany(User::class, 'reservations')
            ->select('users.id', 'first_name', 'last_name', 'email')
            ->using(Reservation::class)
            ->as('reservation')
            ->withPivot('id', 'reservation_date', 'approved_at', 'created_at');
    }
}
