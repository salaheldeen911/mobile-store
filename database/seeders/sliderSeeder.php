<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            Slider::create([
                'image_name' => 'slider_' . $i . '.jpg',
                'path' => 'slider-images/slider_' . $i . '.jpg',
            ]);
        }
    }
}
