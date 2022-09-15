<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'brand_main_image_name', 'brand_lable_image_name', 'brand_main_image_path', 'brand_lable_image_path', 'brand_order'];

}
