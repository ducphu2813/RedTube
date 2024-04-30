<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('interaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('video_id');
            $table->boolean('reaction');
            $table->dateTime('created_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interaction');
    }
};
