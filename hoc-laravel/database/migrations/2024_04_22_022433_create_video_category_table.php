<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id');
            $table->foreignId('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_category');
    }
};
