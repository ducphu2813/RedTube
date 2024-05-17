<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('review_history', function (Blueprint $table) {
            $table->integer('review_id');
            $table->foreignId('reviewer_id');
            $table->foreignId('video_id');
            $table->text('note');
            $table->dateTime('review_date');
            $table->boolean('review_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_history');
    }
};
