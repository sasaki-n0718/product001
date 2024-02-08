<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\User;
use App\Models\Group;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Post::class;
    
    public function definition()
    {
        return [
            'title'=>fake()->sentence(),
            'body'=>fake()->realText(100),
            'user_id'=>User::factory(),
            'group_id'=>Group::factory(),
        ];
    }
}
