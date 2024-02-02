<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_followed_users()
    {
        // Create a user
        $user = User::factory()->create();

        // Log user in
        $this->actingAs($user);

        // Create followers
        $followers = User::factory()->count(5)->create();

        // Make each follower follow the user
        $followers->each(function ($follower) use ($user) {
            $user->addFollower($follower->id);
        });

        // Assert that the user has 5 followers
        $this->assertEquals(5, $user->followers->count());
    }

    /** @test */
    public function a_user_can_remove_followed_users()
    {
        // Create a user
        $user = User::factory()->create();

        // Log user in
        $this->actingAs($user);

        // Create followers
        $followers = User::factory()->count(5)->create();

        // Make each follower follow the user
        $followers->each(function ($follower) use ($user) {
            $user->addFollower($follower->id);
        });

        $user->removeFollower($followers->first()->id);

        // Assert that the user has 5 followers
        $this->assertEquals(4, $user->followers->count());
    }
}
