<?php

namespace Tests\Feature\Routes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Stadium;

class RoutesTest extends TestCase
{
    use RefreshDatabase;


    // Players can see the stadiums list
    public function test_player_can_see_stadiums_list()
    {
        $user = User::factory()->create([

            'role' => 'player',
        ]);

        $response = $this->actingAs($user)
            ->get(route('stadiumsForPlayers.list'));

        $response->assertStatus(200);
    }
    // test if owner can create stadium
    public function test_owner_can_access_create_stadium_page()
    {
        $user = User::factory()->create([
            'role' => 'owner',
        ]);

        $response = $this->actingAs($user)
            ->get(route('create_stadium'));

        $response->assertStatus(200);
    }

    // if stadium will be stored
    public function test_owner_can_store_stadium()
    {
        $user = User::factory()->create([
            'role' => 'owner',
        ]);

        $response = $this->actingAs($user)
            ->post(route('store_stadium'), [
                'name' => 'Test Stadium',
                'location' => 'City',
                'price' => 100,
                'maxPlayer' => 10,
                'minPlayer' => 5,
                'openTime' => '08:00',
                'closeTime' => '22:00',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('stadiums', [
            'name' => 'Test Stadium',
        ]);
    }
    public function test_owner_can_view_stadiums_index()
    {
        $user = User::factory()->create([
            'role' => 'owner',
        ]);

        $response = $this->actingAs($user)
            ->get(route('stadiums_index'));

        $response->assertStatus(200);
    }
    public function test_owner_can_view_bookings()
    {
        $user = User::factory()->create([
            'role' => 'owner',
        ]);

        $response = $this->actingAs($user)
            ->get(route('reservation.lists.index'));

        $response->assertStatus(200);
    }

// -------------------------------------------------
// -------------------------------------------------
// -------------------------------------------------
// -------------------------------------------------

    // public function player_can_view_stadium_details()
    // {
    //     $user = User::factory()->create([
    //         'role' => 'player',
    //     ]);

    //     $stadium = Stadium::factory()->create();

    //     $response = $this->actingAs($user)
    //         ->get(route('show_stadium', $stadium->id));

    //     $response->assertStatus(200);
    // }
    // public function player_can_store_booking()
    // {
    //     $user = User::factory()->create([
    //         'role' => 'player',
    //     ]);

    //     $stadium = Stadium::factory()->create();

    //     $response = $this->actingAs($user)
    //         ->post(route('store.booking', $stadium->id), [
    //             'date' => now()->addDay()->format('Y-m-d'),
    //             'time' => '10:00',
    //         ]);

    //     $response->assertRedirect();
    // }
}
