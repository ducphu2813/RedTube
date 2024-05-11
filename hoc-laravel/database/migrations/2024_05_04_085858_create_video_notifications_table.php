<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video_notifications', function (Blueprint $table) {
            $table->integer('notification_id');
            $table->foreignId('user_id');
            $table->foreignId('video_id');
            $table->text('message');
            $table->dateTime('created_date');
            $table->boolean('is_read');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_notifications');
    }
};
