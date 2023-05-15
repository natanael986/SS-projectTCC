<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Montagem das publicações
            'user_id' => fake()->numberBetween($min = 1, $max = 10),
            'name' => function () {
                $userId = User::inRandomOrder()->pluck('id')->first();
                $user = User::find($userId);
            
                if ($user) {
                    return $user->name;
                }
            
                return null;
            },
            'tittle' => Str::substrReplace(1, fake()->words),
            'publication' => Str::substrReplace(1, fake()->paragraph),
            'context' => Str::substrReplace(1, fake()->sentence),
            'appropriate' => fake()->boolean($chanceOfGettingTrue = 50),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}