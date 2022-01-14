<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Place extends Model
{
    use HasFactory;

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
            ->using(Reservation::class)
            ->as('reservation')
            ->withPivot('date')
            ->withTimestamps();
    }
}
