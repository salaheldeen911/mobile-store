<?php

namespace App\ProductSearch\Filters;

use App\Models\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
