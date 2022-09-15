<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "category" => "required",
            "body_material" => "required",
            "old_price" => "required",
            "price" => "required",
            "brand" => "required",
            "phone_type" => "required",
            "sim_card" => "required",
            "quantity" => "required",
            "operating_system" => "required",
            "processor" => "required",
            "screen_protection" => "required",
            "color" => "required",
            "storage" => "required",
            "ram" => "required",
            "screen_size" => "required",
            "network" => "required",
            "battery" => "required",
            "main_camera" => "required",
            "front_camera" => "required",
            "year" => "required",
            "mainImage" => "required_if:oldMainImage,''|mimes:png,jpg,jpeg|max:5048",
            "oldMainImage" => "required_if:mainImage,''",
            "subImage.*" => "mimes:png,jpg,jpeg|max:5048",
    ];
    }
}
