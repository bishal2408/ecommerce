<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Factory::create();
        $product = Product::all();
        $user = User::all();

        for($i = 0; $i < 200; $i++) {
            Rating::create([
                'product_id' => $faker->randomElement($product)->id,
                'user_id' => $faker->randomElement($user)->id,
                'rating' => $faker->numberBetween(1,5),
            ]);
        }

    }
}
