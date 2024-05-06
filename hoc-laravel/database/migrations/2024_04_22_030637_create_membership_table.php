<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('membership', function (Blueprint $table) {
            $table->id();
            $table->integer('membership_id');
            $table->foreignId('user_id');
            $table->string('name');
            $table->double('price');
            $table->text('description')->nullable();
            $table->integer('duration');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership');
    }
};
