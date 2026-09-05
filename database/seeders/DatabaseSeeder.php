<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BusinessCard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@menjmoi.vn',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Regular User
        $user = User::create([
            'name' => 'Nguyễn Văn A',
            'email' => 'vana@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create Sample Card
        BusinessCard::create([
            'user_id' => $user->id,
            'full_name' => 'Nguyễn Văn A',
            'job_title' => 'Giám đốc Kinh doanh',
            'company' => 'Công ty TNHH Công nghệ ECard',
            'phone' => '0987654321',
            'email' => 'vana@ecard.vn',
            'address' => '123 Đường ABC, Quận Cầu Giấy, Hà Nội',
            'website' => 'https://ecard.vn',
            'facebook_url' => 'https://facebook.com',
            'slug' => 'nguyen-van-a-' . Str::random(5),
            'view_count' => 150,
        ]);

        $this->call(DashboardSeeder::class);
    }
}
