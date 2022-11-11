<?php

namespace App\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Price
{
    public static function apply(Builder $builder, $value)
    {
        foreach ($value as $price) {
            $builder->whereBetween('price', [$price, $price * 2]);
        }

        return $builder;
    }
}
