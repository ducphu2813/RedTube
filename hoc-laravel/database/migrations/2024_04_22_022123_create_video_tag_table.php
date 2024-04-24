<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id');
            $table->foreignId('tag_id');
            $table->unique(['video_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_tag');
    }
};
