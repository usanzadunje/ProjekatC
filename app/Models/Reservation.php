<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Reservation extends Pivot
{
    use HasFactory;

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
        'date' => 'date',
    ];

    public function reservee(): BelongsTo {
        return $this
            ->belongsTo(User::class, 'user_id', 'id', 'users')
            ->select('first_name', 'last_name', 'email');
    }

    public function place(): BelongsTo {
        return $this->belongsTo(Place::class);
    }
}
