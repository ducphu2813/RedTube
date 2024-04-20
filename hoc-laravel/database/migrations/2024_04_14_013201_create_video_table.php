<?php

use App\Models\Users;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->integer('video_id');
            $table->string('title');
            $table->foreignIdFor(Users::class, 'user_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};
