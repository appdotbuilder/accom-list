<?php

namespace Tests\Feature;

use App\Models\Accommodation;
use App\Models\Facility;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccommodationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_accommodations_listing(): void
    {
        $accommodations = Accommodation::factory(3)->active()->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('accommodations/index')
                ->has('accommodations.data', 3)
        );
    }

    public function test_can_view_single_accommodation(): void
    {
        $accommodation = Accommodation::factory()->create();
        $roomType = RoomType::factory()->create(['accommodation_id' => $accommodation->id]);

        $response = $this->get("/accommodations/{$accommodation->id}");

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('accommodations/show')
                ->has('accommodation')
                ->where('accommodation.id', $accommodation->id)
        );
    }

    public function test_can_search_accommodations(): void
    {
        $hotel = Accommodation::factory()->active()->create([
            'name' => 'Grand Hotel',
            'type' => 'hotel',
        ]);
        
        $inn = Accommodation::factory()->active()->create([
            'name' => 'Cozy Inn',
            'type' => 'inn',
        ]);

        $response = $this->get('/?search=Grand');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->has('accommodations.data', 1)
        );
    }

    public function test_can_filter_by_type(): void
    {
        Accommodation::factory()->active()->create(['type' => 'hotel']);
        Accommodation::factory()->active()->create(['type' => 'inn']);
        Accommodation::factory()->active()->create(['type' => 'house']);

        $response = $this->get('/?type=hotel');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->has('accommodations.data', 1)
        );
    }

    public function test_authenticated_user_can_access_admin_accommodations(): void
    {
        $user = User::factory()->create();
        $accommodations = Accommodation::factory(2)->active()->create();

        $response = $this->actingAs($user)->get('/admin/accommodations');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('admin/accommodations/index')
                ->has('accommodations.data', 2)
        );
    }

    public function test_guest_cannot_access_admin(): void
    {
        $response = $this->get('/admin/accommodations');

        $response->assertRedirect('/login');
    }

    public function test_accommodation_has_relationships(): void
    {
        $accommodation = Accommodation::factory()->create();
        $facility = Facility::factory()->create();
        $roomType = RoomType::factory()->create(['accommodation_id' => $accommodation->id]);
        
        $accommodation->facilities()->attach($facility);

        $this->assertTrue($accommodation->facilities->contains($facility));
        $this->assertTrue($accommodation->roomTypes->contains($roomType));
    }
}