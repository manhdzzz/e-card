<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_name',
        'phone',
        'email',
        'address',
        'payment_method',
        'note',
        'status',
        'cancel_reason',
    ];
}
