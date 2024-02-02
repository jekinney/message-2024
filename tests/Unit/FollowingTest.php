<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_following_users()
    {
        // Create a user
        $user = User::factory()->create();

        // Log user in
        $this->actingAs($user);

        // Create followers
        $followers = User::factory()->count(5)->create();

        // Make each follower follow the user
        $followers->each(function ($follower) use ($user) {
            $user->addFollowing($follower->id);
        });

        // Assert that the user has 5 followers
        $this->assertEquals(5, $user->following->count());
    }

    /** @test */
    public function a_user_can_remove_following_users()
    {
        // Create a user
        $user = User::factory()->create();

        // Log user in
        $this->actingAs($user);

        // Create followers
        $followers = User::factory()->count(5)->create();

        // Make each follower follow the user
        $followers->each(function ($follower) use ($user) {
            $user->addFollowing($follower->id);
        });

        // Remove First following user that was just added
        $user->removeFollowing($followers->first()->id);

        // Assert that the user has 4 followers
        $this->assertEquals(4, $user->following->count());
    }
}
