<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'job_title',
        'bio',
        'company',
        'brand_name',
        'phone',
        'email',
        'address',
        'website',
        'avatar',
        'facebook_url',
        'linkedin_url',
        'zalo_url',
        'slug',
        'view_count',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
