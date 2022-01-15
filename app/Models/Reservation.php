<?php

namespace App\Models;

use App\Traits\Excludable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Reservation extends Pivot
{
    use HasFactory, Excludable;

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
}
