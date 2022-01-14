<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    const ADMIN = 1;

    const STAFF = 2;

    const REGULAR = 3;
}
