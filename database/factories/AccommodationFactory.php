<?php

namespace Database\Factories;

use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accommodation>
 */
class AccommodationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['hotel', 'inn', 'house'];
        $type = $this->faker->randomElement($types);
        
        $names = [
            'hotel' => [
                'Grand Palace Hotel',
                'Luxury Resort & Spa',
                'Downtown Business Hotel',
                'Oceanview Hotel',
                'Metropolitan Suites',
                'Royal Garden Hotel',
                'Skyline Tower Hotel',
                'Boutique City Hotel'
            ],
            'inn' => [
                'Cozy Mountain Inn',
                'Riverside Inn',
                'Historic Village Inn',
                'Country Garden Inn',
                'Sunset Valley Inn',
                'Pine Tree Inn',
                'Lakeside Inn',
                'Charming Countryside Inn'
            ],
            'house' => [
                'Luxury Beach House',
                'Mountain Retreat House',
                'Urban Townhouse',
                'Countryside Villa',
                'Modern City House',
                'Traditional Family House',
                'Waterfront House',
                'Garden View House'
            ]
        ];

        return [
            'name' => $this->faker->randomElement($names[$type]),
            'type' => $type,
            'description' => $this->faker->paragraphs(3, true),
            'address' => $this->faker->streetAddress . ', ' . $this->faker->city . ', ' . $this->faker->randomElement(['CA', 'NY', 'TX', 'FL', 'IL']),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'website' => $this->faker->optional(0.7)->url(),
            'price_from' => $this->faker->randomFloat(2, 50, 500),
            'is_active' => $this->faker->boolean(95),
            'featured_image' => $this->faker->optional(0.8)->imageUrl(800, 600, 'architecture'),
            'gallery' => $this->faker->optional(0.6)->randomElements([
                $this->faker->imageUrl(800, 600, 'architecture'),
                $this->faker->imageUrl(800, 600, 'architecture'),
                $this->faker->imageUrl(800, 600, 'architecture'),
            ], random_int(2, 3)),
        ];
    }

    /**
     * Indicate that the accommodation is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the accommodation is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the accommodation is a hotel.
     */
    public function hotel(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'hotel',
            'name' => $this->faker->randomElement([
                'Grand Palace Hotel',
                'Luxury Resort & Spa',
                'Downtown Business Hotel',
                'Oceanview Hotel',
                'Metropolitan Suites',
            ]),
        ]);
    }

    /**
     * Indicate that the accommodation is an inn.
     */
    public function inn(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'inn',
            'name' => $this->faker->randomElement([
                'Cozy Mountain Inn',
                'Riverside Inn',
                'Historic Village Inn',
                'Country Garden Inn',
            ]),
        ]);
    }

    /**
     * Indicate that the accommodation is a house.
     */
    public function house(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'house',
            'name' => $this->faker->randomElement([
                'Luxury Beach House',
                'Mountain Retreat House',
                'Urban Townhouse',
                'Countryside Villa',
            ]),
        ]);
    }
}