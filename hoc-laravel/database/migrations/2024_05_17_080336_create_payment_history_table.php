<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_history', function (Blueprint $table) {
            $table->integer('payment_id');
            $table->foreignId('user_id');
            $table->dateTime('payment_date');
            $table->double('amount');
            $table->string('full_name');
            $table->string('address');
            $table->string('phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_history');
    }
};
