<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('premium_package', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->string('name');
            $table->double('price');
            $table->integer('duration');
            $table->string('description')->nullable();
            $table->integer('share_limit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('premium_package');
    }
};
