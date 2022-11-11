<?php

namespace App\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Sort
{
    public static function apply(Builder $builder, $value)
    {
        if ($value) {
            return $builder->orderBy('price', $value);
        }

        return $builder;
    }
}
