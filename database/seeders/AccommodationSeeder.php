<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\Facility;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class AccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create facilities first
        $facilities = [
            ['name' => 'Free Wi-Fi', 'icon' => 'wifi'],
            ['name' => 'Swimming Pool', 'icon' => 'pool'],
            ['name' => 'Fitness Center', 'icon' => 'fitness'],
            ['name' => 'Spa & Wellness', 'icon' => 'spa'],
            ['name' => 'Restaurant', 'icon' => 'restaurant'],
            ['name' => 'Bar/Lounge', 'icon' => 'bar'],
            ['name' => 'Room Service', 'icon' => 'room-service'],
            ['name' => 'Parking', 'icon' => 'parking'],
            ['name' => 'Airport Shuttle', 'icon' => 'shuttle'],
            ['name' => 'Conference Rooms', 'icon' => 'conference'],
            ['name' => 'Pet Friendly', 'icon' => 'pet'],
            ['name' => 'Laundry Service', 'icon' => 'laundry'],
            ['name' => 'Concierge', 'icon' => 'concierge'],
            ['name' => 'Air Conditioning', 'icon' => 'ac'],
            ['name' => 'Garden/Terrace', 'icon' => 'garden'],
            ['name' => 'Beach Access', 'icon' => 'beach'],
            ['name' => 'Hot Tub/Jacuzzi', 'icon' => 'hot-tub'],
            ['name' => 'Kids Club', 'icon' => 'kids'],
            ['name' => 'Business Center', 'icon' => 'business'],
            ['name' => 'Non-Smoking', 'icon' => 'no-smoking'],
        ];

        foreach ($facilities as $facilityData) {
            Facility::firstOrCreate(
                ['name' => $facilityData['name']],
                $facilityData
            );
        }

        $allFacilities = Facility::all();

        // Create accommodations with room types and facilities
        Accommodation::factory(25)->create()->each(function ($accommodation) use ($allFacilities) {
            // Attach random facilities to each accommodation
            $randomFacilities = $allFacilities->random(random_int(3, 8));
            $accommodation->facilities()->attach($randomFacilities);

            // Create room types for each accommodation
            $roomTypeCount = random_int(2, 4);
            
            for ($i = 0; $i < $roomTypeCount; $i++) {
                RoomType::factory()->create([
                    'accommodation_id' => $accommodation->id,
                ]);
            }
        });

        // Create some specific featured accommodations
        $featuredAccommodations = [
            [
                'name' => 'Grand Ocean Resort & Spa',
                'type' => 'hotel',
                'description' => 'Experience luxury at its finest at our 5-star oceanfront resort. With pristine beaches, world-class spa facilities, and exceptional dining options, your stay will be unforgettable. Each room features breathtaking ocean views and modern amenities designed for ultimate comfort.',
                'address' => '123 Ocean Drive, Miami Beach, FL',
                'latitude' => 25.7617,
                'longitude' => -80.1918,
                'phone' => '+1 (555) 123-4567',
                'email' => 'reservations@grandoceanresort.com',
                'website' => 'https://grandoceanresort.com',
                'price_from' => 299.00,
                'is_active' => true,
            ],
            [
                'name' => 'Mountain View Inn',
                'type' => 'inn',
                'description' => 'Nestled in the heart of the mountains, our cozy inn offers a peaceful retreat from city life. Enjoy hiking trails, fresh mountain air, and warm hospitality. Perfect for couples seeking a romantic getaway or families looking for outdoor adventures.',
                'address' => '456 Mountain Trail, Aspen, CO',
                'latitude' => 39.1911,
                'longitude' => -106.8175,
                'phone' => '+1 (555) 987-6543',
                'email' => 'info@mountainviewinn.com',
                'website' => 'https://mountainviewinn.com',
                'price_from' => 159.00,
                'is_active' => true,
            ],
            [
                'name' => 'Downtown Luxury Loft',
                'type' => 'house',
                'description' => 'Modern luxury meets urban convenience in this stunning downtown loft. With floor-to-ceiling windows, contemporary furnishings, and top-tier amenities, you\'ll have the perfect home base for exploring the city. Walking distance to restaurants, shopping, and entertainment.',
                'address' => '789 City Center Blvd, New York, NY',
                'latitude' => 40.7589,
                'longitude' => -73.9851,
                'phone' => '+1 (555) 456-7890',
                'email' => 'contact@downtownloft.com',
                'price_from' => 225.00,
                'is_active' => true,
            ],
        ];

        foreach ($featuredAccommodations as $accommodationData) {
            $accommodation = Accommodation::create($accommodationData);
            
            // Attach facilities
            $facilityCount = random_int(5, 10);
            $randomFacilities = $allFacilities->random($facilityCount);
            $accommodation->facilities()->attach($randomFacilities);

            // Create room types
            $roomTypesData = [
                [
                    'name' => 'Standard Room',
                    'description' => 'Comfortable room with essential amenities',
                    'price_per_night' => $accommodation->price_from,
                    'max_occupancy' => 2,
                    'size_sqm' => 25,
                    'amenities' => ['Wi-Fi', 'Air Conditioning', 'TV', 'Private Bathroom'],
                ],
                [
                    'name' => 'Deluxe Room',
                    'description' => 'Spacious room with enhanced amenities and better views',
                    'price_per_night' => $accommodation->price_from * 1.4,
                    'max_occupancy' => 2,
                    'size_sqm' => 35,
                    'amenities' => ['Wi-Fi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'Ocean View', 'Work Desk'],
                ],
                [
                    'name' => 'Family Suite',
                    'description' => 'Perfect for families with separate living area',
                    'price_per_night' => $accommodation->price_from * 1.8,
                    'max_occupancy' => 4,
                    'size_sqm' => 50,
                    'amenities' => ['Wi-Fi', 'Air Conditioning', 'Smart TV', 'Kitchenette', 'Living Area', 'Balcony'],
                ],
            ];

            foreach ($roomTypesData as $roomTypeData) {
                $accommodation->roomTypes()->create($roomTypeData);
            }
        }
    }
}