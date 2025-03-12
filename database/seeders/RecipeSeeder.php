<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                Recipe::create([
                    'user_id' => $user->id,
                    'title' => 'Sample Recipe ' . Str::random(5),
                    'category' => 'Sample Category ' . Str::random(5),
                    'image' => null,
                    'description' => 'This is a sample description for a recipe.',
                    'preparation_time' => now()->setTime(rand(0, 2), rand(10, 59))->format('H:i:s'),
                    'serves' => rand(1, 10),
                    'cooking_instructions' => 'Step 1: Do this. Step 2: Do that.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
