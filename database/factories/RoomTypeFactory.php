<?php

namespace Database\Factories;

use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roomTypes = [
            [
                'name' => 'Standard Room',
                'description' => 'Comfortable room with all basic amenities for a pleasant stay.',
                'price_base' => 80,
                'occupancy' => 2,
                'size' => 25,
                'amenities' => ['Wi-Fi', 'Air Conditioning', 'TV', 'Private Bathroom']
            ],
            [
                'name' => 'Deluxe Room',
                'description' => 'Spacious room with enhanced amenities and city views.',
                'price_base' => 120,
                'occupancy' => 2,
                'size' => 35,
                'amenities' => ['Wi-Fi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'City View', 'Work Desk']
            ],
            [
                'name' => 'Family Suite',
                'description' => 'Large suite perfect for families with separate living area.',
                'price_base' => 180,
                'occupancy' => 4,
                'size' => 50,
                'amenities' => ['Wi-Fi', 'Air Conditioning', 'Smart TV', 'Kitchenette', 'Living Area', 'Balcony']
            ],
            [
                'name' => 'Executive Suite',
                'description' => 'Premium suite with luxury amenities and panoramic views.',
                'price_base' => 250,
                'occupancy' => 2,
                'size' => 45,
                'amenities' => ['Wi-Fi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'Panoramic View', 'Premium Bathroom', 'Work Area']
            ],
            [
                'name' => 'Presidential Suite',
                'description' => 'Ultimate luxury suite with the finest amenities and services.',
                'price_base' => 400,
                'occupancy' => 4,
                'size' => 80,
                'amenities' => ['Wi-Fi', 'Air Conditioning', 'Smart TV', 'Full Kitchen', 'Living Room', 'Dining Area', 'Premium View', 'Butler Service']
            ]
        ];

        $roomType = $this->faker->randomElement($roomTypes);
        $priceVariation = $this->faker->randomFloat(2, 0.8, 1.3);

        return [
            'name' => $roomType['name'],
            'description' => $roomType['description'],
            'price_per_night' => round($roomType['price_base'] * $priceVariation, 2),
            'max_occupancy' => $roomType['occupancy'],
            'size_sqm' => $roomType['size'] + random_int(-5, 10),
            'amenities' => $roomType['amenities'],
            'image' => $this->faker->optional(0.7)->imageUrl(600, 400, 'room'),
            'is_available' => $this->faker->boolean(90),
        ];
    }

    /**
     * Indicate that the room type is unavailable.
     */
    public function unavailable(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_available' => false,
        ]);
    }

    /**
     * Create a standard room type.
     */
    public function standard(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Standard Room',
            'description' => 'Comfortable room with all basic amenities for a pleasant stay.',
            'price_per_night' => $this->faker->randomFloat(2, 60, 100),
            'max_occupancy' => 2,
            'size_sqm' => random_int(20, 30),
            'amenities' => ['Wi-Fi', 'Air Conditioning', 'TV', 'Private Bathroom'],
        ]);
    }

    /**
     * Create a deluxe room type.
     */
    public function deluxe(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Deluxe Room',
            'description' => 'Spacious room with enhanced amenities and beautiful views.',
            'price_per_night' => $this->faker->randomFloat(2, 100, 150),
            'max_occupancy' => 2,
            'size_sqm' => random_int(30, 40),
            'amenities' => ['Wi-Fi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'City View', 'Work Desk'],
        ]);
    }

    /**
     * Create a suite room type.
     */
    public function suite(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Executive Suite',
            'description' => 'Premium suite with luxury amenities and exceptional service.',
            'price_per_night' => $this->faker->randomFloat(2, 200, 300),
            'max_occupancy' => 4,
            'size_sqm' => random_int(40, 60),
            'amenities' => ['Wi-Fi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'Panoramic View', 'Premium Bathroom', 'Living Area'],
        ]);
    }
}