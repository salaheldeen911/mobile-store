<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'name' => $this->faker->name(),
            // 'category' => $this->faker->name(),
            // 'img' => $this->faker->numberBetween(1,100000),
            // 'quantity' => $this->faker->numberBetween(1,100000), Not Working
            // 'price' => $this->faker->numberBetween(1,100000),
            // 'description' => $this->faker->name(),
            // 'likes' => $this->faker->numberBetween(1,100000),
            // 'seller_id' =>  1,
        ];
    }
}
