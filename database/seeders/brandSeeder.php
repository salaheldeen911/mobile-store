<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 7; $i++) {
            Brand::create([
                'brand_main_image_name' => 'brand_img_' . $i . '.png',
                'brand_main_image_path' => 'brands-images/brand_img_' . $i . '.png',
                'brand_lable_image_name' => 'brand_lable_' . $i . '.png',
                'brand_lable_image_path' => 'brands-images/brand_lable_' . $i . '.png',
                'brand_order' => $i,
            ]);
        }
    }
}
