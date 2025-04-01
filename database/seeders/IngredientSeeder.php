<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Ingredient;
use Faker\Factory as Faker;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $recipes = Recipe::all();

        if ($recipes->isEmpty()) {
            $this->command->info('No recipes found. Please seed the recipes table first.');
            return;
        }

        foreach ($recipes as $recipe) {
            for ($i = 0; $i < rand(3, 6); $i++) {
                Ingredient::create([
                    'recipe_id' => $recipe->id,
                    'ingredient_name' => $faker->word,
                    'quantity' => number_format($faker->randomFloat(2, 0.1, 5), 2, '.', ''), 
                    'unit' => $faker->randomElement(['cups', 'tablespoons', 'teaspoons', 'grams', 'liters']),
                    'price' => number_format($faker->randomFloat(2, 10, 100), 2, '.', ''), 
                ]);

            }
        }
    }
}
