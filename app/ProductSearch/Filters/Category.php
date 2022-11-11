<?php

namespace App\ProductSearch\Filters;

use App\Models\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class Category
{
    // public static function apply(Request $filters, Product $product)
    // {
    //     $query = $product->newQuery();

    //     $query = static::applyFiltersToQuery($filters, $query);

    //     if ($filters->has('name')) {
    //         $products->where('name', 'like', '%' . $filters->name . '%');
    //     }
    //     if ($filters->has('category')) {
    //         $products->whereIn('category', $filters->category);
    //     }
    //     if ($filters->has('price')) {
    //         foreach ($filters->price as $value) {
    //             $products->whereBetween('price', [$value, $value * 2]);
    //         }
    //     }
    //     if ($filters->has('brand')) {
    //         $products->whereIn('brand', $filters->brand);
    //     }
    //     if ($filters->has('color')) {
    //         $products->where('color', $filters->color);
    //     }
    //     if ($filters->has('sort') && $filters->sort !== null) {
    //         $products = $products->orderBy('price', $filters->sort);
    //     }

    //     return $products->paginate(4);
    // }

    public static function apply(Builder $builder, $value)
    {
        return $builder->whereIn('category', $value);
    }
}
