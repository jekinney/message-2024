<?php

namespace Tests\Feature;

use App\Models\Message;
use Tests\TestCase;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessagesTest extends TestCase
{
   use WithFaker, RefreshDatabase;

    /**
     * Simple test to get started with.
     * Only testing a single user can
     * see their own messages in a
     * paginated list
     */
    public function test_a_user_can_see_feed_with_own_messages(): void
    {
        // Create a user
        $user = User::factory()->create();

        // Create some messages assume auth user is the author id being set
        Message::factory()->count(10)->create([
            'author_id' => $user->id
        ]);

       $this->actingAs($user)
            ->get('/messages')
            ->assertInertia(function (Assert $page) {
                $page->has('messages');
            });
    }

    /**
     * Test a user can see self and followers messages
     */
    public function test_a_user_can_see_feed_with_all_messages(): void
    {
        // Create a user
        $author = User::factory()->create();

        // Create some messages assume auth user is the author id being set
        Message::factory()->count(10)->create([
            'author_id' => $author->id
        ]);

        $users = User::factory(5)->create();

        foreach( $users as $user ) {
            Message::factory()->count(10)->create([
                'author_id' => $user->id
            ]);
        }

        $this->actingAs($author)
            ->get('/messages')
            ->assertInertia(function (Assert $page) {
                $page->has('messages');
        });

    }
}
