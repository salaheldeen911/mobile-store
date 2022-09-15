<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.site.brand.index');
    }

    public function update(UpdateBrandRequest $request)
    {

        $brand = Brand::where("id", $request->id);
       
        $brand->update([
            "brand" => $request->brand,
        ]);

        if ($request->image) {

            $name = $brand->first()->brand_main_image_name;
            if(File::exists(storage_path("app/public/images/brands/$name"))){
                File::delete(storage_path("app/public/images/brands/$name"));
            }

            $extention = $request->image->extension();
            $imgName = "brand_img_$request->id.$extention";
            $imgPath = "brands-images/brand_img_$request->id.$extention";
            $brand->update([
                'brand_main_image_name' => $imgName,
                'brand_main_image_path' => $imgPath,
            ]);

            $path = 'images/brands';
            $request->image->storeAs($path, $imgName);
        }

        if ($request->lable) {

            $name = $brand->first()->brand_lable_image_name;
            if(File::exists(storage_path("app/public/images/brands/$name"))){
                File::delete(storage_path("app/public/images/brands/$name"));
            }
            $extention = $request->lable->extension();
            $lableName = "brand_lable_$request->id.$extention";
            $lablePath = "brands-images/brand_lable_$request->id.$extention";
            $brand->update([
                'brand_lable_image_name' => $lableName,
                'brand_lable_image_path' => $lablePath,
            ]);
            $path = 'images/brands';
            $request->lable->storeAs($path, $lableName);
        }

        return response()->json(['message' => $request->all()]);
    }
}
