<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('premium_registration', function (Blueprint $table) {
            $table->id();
            $table->integer('registration_id');
            $table->foreignId('user_id');
            $table->foreignId('package_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('premium_registration');
    }
};
