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
            $table->string('user_name');
            $table->string('channel_name');
            $table->string('email');
            $table->string('password');
            $table->string('description')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->boolean('active');
            $table->string('picture_url')->nullable();
            $table->integer('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
