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
     * @param array|string $columns
     * @return Builder
     */
    public function scopeFilter(Builder $query, string $filter, array|string $columns): Builder {
        if(is_string($columns)) {
            $columns = [$columns];
        }

        for($i = 0; $i < count($columns); $i++){
            $query
                /**
                 * This check makes sure that when filter scope is chained it provides AND operator on
                 * where constraint so integrity of data filtered is not compromised.
                 */
                ->when(
                    $i === 0,
                    fn(Builder $query) => $query->where($columns[$i], 'LIKE', "%$filter%"),
                    fn(Builder $query) => $query->orWhere($columns[$i], 'LIKE', "%$filter%"),
                );
        }

        return $query;
    }
}