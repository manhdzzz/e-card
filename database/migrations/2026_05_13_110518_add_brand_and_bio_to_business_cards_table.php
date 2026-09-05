<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('business_cards', function (Blueprint $table) {
            $table->string('brand_name')->nullable()->after('company');
            $table->text('bio')->nullable()->after('job_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_cards', function (Blueprint $table) {
            $table->dropColumn(['brand_name', 'bio']);
        });
    }
};
