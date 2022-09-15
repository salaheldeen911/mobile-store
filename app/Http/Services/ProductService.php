<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\SubImage;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;


class ProductService{
    public function storeImages($product, $request){
        $path = public_path() . '/images/products/' . $product->id;

        if (File::isDirectory($path)) {
            File::deleteDirectory($path);
        }
        File::makeDirectory($path, 0777, true, true);

        $mainImgName = "/images/products/" . $product->id . "/main-" . $product->id . "-" . uniqid() . '.' . $request->mainImage->extension();

        $product->update([
            "main_image" => $mainImgName,
        ]);
        $request->mainImage->move($path, $mainImgName);

        if ($request->subImage) {
            foreach ($request->subImage as $img) {
                $subImgName = "/images/products/" . $product->id . "/sub-" . $product->id . "-" . uniqid() . '.' . $img->extension();
                SubImage::create([
                    "product_id" => $product->id,
                    "sub_image" => $subImgName,
                ]);
                $img->move($path, $subImgName);
            }
        }
    }

    public function updateImages($product, $request){
     /////////////////////////// main image start /////////////////////////////
     if (!$request->oldMainImage && $request->mainImage) {  // New main image
        $path = public_path() . '/images/products/' . $product->id;
        File::delete(public_path($product->main_image));
        $mainImgName = "/images/products/" . $product->id . "/main-" . $product->id . "-" . uniqid() . '.' . $request->mainImage->extension();

        $request->mainImage->move($path, $mainImgName);
        $product->update([
            "main_image" => $mainImgName,
        ]);
    }
    /////////////////////////// main image end /////////////////////////////

    /////////////////////////// sub images start /////////////////////////////
    if (SubImage::where('product_id', $product->id)) { // there are old sub images
        if ($request->oldSubImages) { // some or all old images still there
            $deletedSubImages = SubImage::whereNotIn('id', $request->oldSubImages)->get(); // delated old sub_images ids

            if ($deletedSubImages->count() !== 0) { // there are delated old sub_images
                foreach ($deletedSubImages->toArray() as $subImage) {
                    File::delete(public_path($subImage['sub_image']));    // delete theme from the project
                }

                SubImage::whereNotIn('id', $request->oldSubImages)->delete(); // delete theme from the data base
            }
        } else { // all sub images have been deleted
            $deletedImages = SubImage::where('product_id', $product->id)->get();

            foreach ($deletedImages->toArray() as $deletedImage) {
                File::delete(public_path($deletedImage['sub_image'])); // delete all files from the project
                SubImage::where('product_id', $product->id)->delete(); // delete all files from the data base
            }
        }
    }
    /////////// new sub images
    if ($request->subImage) { // there is new sub images

        foreach ($request->subImage as $img) {
            $subImgName = "/images/products/" . $product->id . "/sub-" . $product->id . "-" . uniqid() . '.' . $img->extension();
            SubImage::create([
                "product_id" => $product->id,
                "sub_image" => $subImgName,
            ]);
            $path = public_path() . '/images/products/' . $product->id;
            $img->move($path, $subImgName);
        }
    }
    }

    public function dataTable($data){
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btns = '<a href="products/' . $row->id . '">
                                <span class="jsgrid-button jsgrid-edit-button ti-eye" type="button" title="Edit"></span>
                            </a>

                            <a href="products/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteProduct(this)">
                                    <span class="jsgrid-button jsgrid-delete-button ti-trash" type="button" title="Delete"></span>
                            </a>

                            <form action="products/' . $row->id . '" method="POST" style="display: none">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                
                            </form>';

                    return $btns;
                })
                ->setRowId(function ($product) {
                    return $product->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->rawColumns(['action'])
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at->diffForHumans();
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->editColumn('brand', function ($row) {
                    return $row->brand;
                })
                ->editColumn('category', function ($row) {
                    return Product::getAllProductCategories()[$row->category];
                })
                ->make(true);
    }
}