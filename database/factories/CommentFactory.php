<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $blogs = Blog::all()->pluck('id')->toArray();

        return [
            'title' => $this->faker->title,
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'comment' => $this->faker->text,
            'blog_id' => $this->faker->randomElement($blogs)
        ];
    }
}
