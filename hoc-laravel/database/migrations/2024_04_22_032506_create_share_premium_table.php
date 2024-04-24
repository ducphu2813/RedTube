<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('share_premium', function (Blueprint $table) {
            $table->id();
            $table->integer('share_id');
            $table->foreignId('user_id');
            $table->foreignId('premium_registration_id');
            $table->dateTime('created_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('share_premium');
    }
};
