<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.site.slider.index');
    }

    public function update(UpdateSliderRequest $request)
    {
        $slider = Slider::where("id", $request->id)->first();
        $fileName = "slider_" . $slider->id;

        $extention = $request->file->extension();

        $slider->update([
            "product_id" => $request->product,
            'image_name' => $fileName . '.' . $extention,
            'path' => 'slider-images/' . $fileName . '.' . $extention,
        ]);

        $path = 'images/slider';

        $request->file->storeAs($path, $fileName . '.' . $extention);

        return response()->json(['message' => $request->all()]);
    }
}
