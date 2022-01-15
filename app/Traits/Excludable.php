<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Schema;

trait Excludable
{
    /**
     * Returns all columns for current model.
     *
     * @return Attribute
     */
    public function columns(): Attribute {
        return new Attribute(
            get: fn() => Schema::getColumnListing($this->getTable())
        );
    }

    /**
     * Excludes provided columns from select.
     *
     * @param Builder $query
     * @param array|string $excludedColumns
     * @return Builder
     */
    public function scopeExclude(Builder $query, array|string $excludedColumns): Builder {
        if(is_string($excludedColumns)) {
            $excludedColumns = [$excludedColumns];
        }

        return $query->select(array_diff($this->columns, $excludedColumns));
    }
}