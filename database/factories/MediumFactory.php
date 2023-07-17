<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Book;
use App\Models\ElectronicMedia;
use App\Models\Magazine;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medium>
 */
class MediumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mediable = fake()->randomElement([
            Book::class,
            ElectronicMedia::class,
            Magazine::class,
        ]);

        return [
            'mediable_type' => array_search($mediable, Relation::$morphMap),
            'mediable_id' => $mediable::factory(),
        ];
    }
}
