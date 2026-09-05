<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_name');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->string('payment_method');
            $table->text('note')->nullable();
            $table->string('status')->default('pending'); // pending, processing, shipped, completed, cancelled
            $table->text('cancel_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
