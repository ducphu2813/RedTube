<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->integer('video_id');
            $table->string('title');
            $table->foreignId('user_id');
            $table->dateTime('created_date');
            $table->integer('view');
            $table->longText('description')->nullable();
            $table->boolean('display_mode');
            $table->boolean('membership');
            $table->boolean('active');
            $table->string('video_path');
            $table->string('thumbnail_path');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};
