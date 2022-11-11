<?php

namespace App\ProductSearch;

use App\Models\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ProductsSearch
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

    // public static function applyFiltersToQuery(Request $filters, $query)
    // {
    // }


    public static function apply(Request $filters)
    {
        $query = static::applyDecoratorsFromRequest($filters, (new Product())->newQuery());
        return static::getResults($query);
    }

    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {

            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                $result = $decorator::apply(
                    $query,
                    $value
                );
            }
        }
        return $result;
    }

    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . ucwords($name);
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    private static function getResults(Builder $query)
    {
        return $query->paginate(4);
    }
}
