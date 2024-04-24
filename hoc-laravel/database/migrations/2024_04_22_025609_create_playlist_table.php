<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('playlist', function (Blueprint $table) {
            $table->id();
            $table->integer('playlist_id');
            $table->foreignId('user_id');
            $table->string('name');
            $table->dateTime('created_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('playlist');
    }
};
