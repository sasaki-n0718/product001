<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Post;

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
            'title'=>fake()->word(),
            'body'=>fake()->text(100),
            'user_id'=>function(){
                return User->id;
            }
        ];
    }
}
