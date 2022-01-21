<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Scope a query to filter resource using LIKE database operator for provided columns.
     *
     * @param Builder $query
     * @param string $filter
     * @param array $columns
     * @return Builder
     */
    public function scopeFilter(Builder $query, string $filter, array $columns): Builder {
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', "%$filter%");
        }

        return $query;
    }
}