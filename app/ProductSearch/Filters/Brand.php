<?php

namespace App\ProductSearch\Filters;

use App\Models\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class Brand
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->whereIn('brand', $value);
    }
}
