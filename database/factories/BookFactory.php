<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'cover_url' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
            'author_id' => \App\Models\Author::factory(),
            'pages' => $this->faker->numberBetween(100, 1000),
            'publication_year' => $this->faker->year,
            'publisher_id' => \App\Models\Publisher::factory(),
            'genre_id' => \App\Models\Genre::factory(),
            'stock' => $this->faker->numberBetween(0, 100),
            'active' => $this->faker->boolean,
            'ISBN' => $this->faker->isbn13,
        ];
    }
}
