<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected Hasher $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function run(): void
    {
        User::factory()->create([
            'email'    => 'user@example.com',
            'password' => $this->hasher->make('secret'),
        ]);
    }
}
