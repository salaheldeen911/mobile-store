<?php

namespace App\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Category
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->whereIn('category', $value);
    }
}
