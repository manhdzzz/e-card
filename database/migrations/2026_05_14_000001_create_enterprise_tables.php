<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add enterprise fields to users
        Schema::table('users', function (Blueprint $table) {
            $table->string('account_type')->default('personal')->after('role'); // personal | enterprise
            $table->unsignedBigInteger('company_id')->nullable()->after('account_type');
        });

        // Companies table
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tax_code')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Departments table
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        // Employees table
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('full_name');
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        // Add FK to users after companies table exists
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn(['account_type', 'company_id']);
        });
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('companies');
    }
};
