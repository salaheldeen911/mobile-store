<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\File;
use App\Http\Services\ProductService;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.products.index');
    }

    public function showAllProducts(Request $request, ProductService $service)
    {
        if ($request->ajax()) {
            $data = Product::all();

            return $service->dataTable($data);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.products.create")->with("product_details", new Product());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request, ProductService $service)
    {
        $product = Product::create(array_merge($request->all(), ["seller_id" => auth()->user()->id]));

        $service->storeImages($product, $request);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view("admin.products.show")->with("product", $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view("admin.products.edit")
            ->with(["product" => $product, "product_details" => new Product()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id, ProductService $service)
    {
        $product = Product::where('id', $id)->first();

        $product->update($request->all());

        $service->updateImages($product, $request);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $path = public_path() . '/images/' . $product->id . '-' . $product->color;
        File::deleteDirectory($path);

        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
