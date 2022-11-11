<?php

namespace App\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Name
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('name', 'like', '%' . $value . '%');
    }
}
