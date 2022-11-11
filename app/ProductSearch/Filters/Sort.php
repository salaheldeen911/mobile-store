<?php

namespace App\ProductSearch\Filters;

use App\Models\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
