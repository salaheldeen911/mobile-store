<?php

namespace App\ProductSearch\Filters;

use App\Models\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class Name
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('name', 'like', '%' . $value . '%');
    }
}
