<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{
    User,
    Message
};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->makeMessages(50);
    }

    public function makeMessages(int $amount = 10): void
    {
        foreach ( User::get() as $user ) {
            Message::factory($amount)->create([
                'author_id' => $user->id
            ]);
        }
    }
}
