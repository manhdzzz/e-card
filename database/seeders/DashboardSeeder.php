<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BusinessCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardSeeder extends Seeder
{
    public function run()
    {
        // Create 20 users for the last 30 days
        for ($i = 0; $i < 20; $i++) {
            $date = now()->subDays(rand(0, 30));
            $user = User::create([
                'name' => 'User ' . Str::random(5),
                'email' => 'user' . $i . '_' . Str::random(3) . '@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'is_active' => rand(0, 10) > 1,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            // Create 1-3 cards per user
            $numCards = rand(1, 3);
            for ($j = 0; $j < $numCards; $j++) {
                $cardDate = (clone $date)->addHours(rand(1, 48));
                $viewCount = rand(50, 500);
                $card = BusinessCard::create([
                    'user_id' => $user->id,
                    'full_name' => 'Business Card ' . Str::random(5),
                    'job_title' => 'Manager',
                    'company' => 'Company ' . Str::random(3),
                    'phone' => '09' . rand(10000000, 99999999),
                    'email' => $user->email,
                    'slug' => Str::slug('Card ' . Str::random(10)),
                    'view_count' => $viewCount,
                    'created_at' => $cardDate,
                    'updated_at' => $cardDate,
                ]);

                // Create random views for the chart
                for ($k = 0; $k < 20; $k++) {
                    $viewDate = (clone $cardDate)->addDays(rand(0, 5));
                    if ($viewDate <= now()) {
                        DB::table('card_views')->insert([
                            'card_id' => $card->id,
                            'ip_address' => '127.0.0.' . rand(1, 255),
                            'created_at' => $viewDate,
                            'updated_at' => $viewDate,
                        ]);
                    }
                }
            }
        }
    }
}
