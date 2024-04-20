<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('user_name')->unique();
            $table->string('channel_name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('description')->nullable();
            $table->dateTime('created_date');
            $table->boolean('active');
            $table->string('picture_url')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('token_expire')->nullable();
            $table->int('role');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
