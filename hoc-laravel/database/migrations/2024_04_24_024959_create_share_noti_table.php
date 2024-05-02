<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('share_noti', function (Blueprint $table) {
            $table->id();
            $table->integer('noti_id');
            $table->foreignId('sender_id');
            $table->foreignId('receiver_id');
            $table->foreignId('registration_id');
            $table->boolean('status');
            $table->dateTime('created_date');
            $table->dateTime('expiry_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('share_noti');
    }
};
