<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'url' => $this->faker->url,
            'slug' => Str::slug($this->faker->title),
            'excerpt' => 'This is an excerpt',
            'content' => [
                'key' => 'value'
            ]
        ];
    }
}
