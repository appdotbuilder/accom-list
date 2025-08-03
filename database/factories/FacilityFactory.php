<?php

namespace Database\Factories;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $facilities = [
            ['name' => 'Free Wi-Fi', 'icon' => 'wifi', 'description' => 'Complimentary high-speed internet access throughout the property'],
            ['name' => 'Swimming Pool', 'icon' => 'pool', 'description' => 'Outdoor swimming pool with lounging area'],
            ['name' => 'Fitness Center', 'icon' => 'fitness', 'description' => 'Fully equipped gym with modern exercise equipment'],
            ['name' => 'Spa & Wellness', 'icon' => 'spa', 'description' => 'Relaxing spa treatments and wellness facilities'],
            ['name' => 'Restaurant', 'icon' => 'restaurant', 'description' => 'On-site dining with local and international cuisine'],
            ['name' => 'Bar/Lounge', 'icon' => 'bar', 'description' => 'Cocktail bar and lounge area for evening entertainment'],
            ['name' => 'Room Service', 'icon' => 'room-service', 'description' => '24-hour room service available'],
            ['name' => 'Parking', 'icon' => 'parking', 'description' => 'Free parking available on-site'],
            ['name' => 'Airport Shuttle', 'icon' => 'shuttle', 'description' => 'Complimentary airport transportation service'],
            ['name' => 'Conference Rooms', 'icon' => 'conference', 'description' => 'Meeting and conference facilities for business travelers'],
            ['name' => 'Pet Friendly', 'icon' => 'pet', 'description' => 'Pets are welcome with additional fees'],
            ['name' => 'Laundry Service', 'icon' => 'laundry', 'description' => 'Professional laundry and dry cleaning services'],
            ['name' => 'Concierge', 'icon' => 'concierge', 'description' => 'Professional concierge services for local recommendations'],
            ['name' => 'Air Conditioning', 'icon' => 'ac', 'description' => 'Climate-controlled rooms for your comfort'],
            ['name' => 'Garden/Terrace', 'icon' => 'garden', 'description' => 'Beautiful outdoor spaces and garden areas'],
            ['name' => 'Beach Access', 'icon' => 'beach', 'description' => 'Direct access to private or nearby beach'],
            ['name' => 'Hot Tub/Jacuzzi', 'icon' => 'hot-tub', 'description' => 'Relaxing hot tub and jacuzzi facilities'],
            ['name' => 'Kids Club', 'icon' => 'kids', 'description' => 'Supervised activities and entertainment for children'],
            ['name' => 'Business Center', 'icon' => 'business', 'description' => 'Computer and printing facilities for business needs'],
            ['name' => 'Non-Smoking', 'icon' => 'no-smoking', 'description' => 'Smoke-free environment throughout the property'],
        ];

        $facility = $this->faker->randomElement($facilities);

        return [
            'name' => $facility['name'],
            'icon' => $facility['icon'],
            'description' => $facility['description'],
        ];
    }
}