<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BusinessCard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 users
        for ($i = 1; $i <= 50; $i++) {
            $user = User::create([
                'name' => 'Demo User ' . $i,
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => rand(0, 10) > 2, // 80% active
                'created_at' => now()->subDays(rand(1, 30)),
            ]);

            // Create 1-3 cards for each user
            for ($j = 1; $j <= rand(1, 3); $j++) {
                BusinessCard::create([
                    'user_id' => $user->id,
                    'full_name' => $user->name . ' Card ' . $j,
                    'job_title' => ['Developer', 'Designer', 'Manager', 'Sales'][rand(0, 3)],
                    'company' => 'Company ' . rand(1, 20),
                    'phone' => '09' . rand(10000000, 99999999),
                    'email' => $user->email,
                    'website' => 'https://example.com',
                    'slug' => Str::slug($user->name . ' ' . $j) . '-' . Str::random(5),
                    'view_count' => rand(0, 500),
                    'created_at' => $user->created_at->addHours(rand(1, 24)),
                ]);
            }
        }
    }
}
