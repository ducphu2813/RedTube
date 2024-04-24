<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_membership', function (Blueprint $table) {
            $table->id();
            $table->integer('subscription_id');
            $table->foreignId('user_id');
            $table->foreignId('membership_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_membership');
    }
};
