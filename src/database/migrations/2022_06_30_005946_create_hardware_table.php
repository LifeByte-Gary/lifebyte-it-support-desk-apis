<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hardware', static function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('brand');
            $table->string('model');
            $table->string('serial_number');
            $table->string('tag');
            $table->string('spec_os')->nullable();
            $table->string('spec_cpu')->nullable();
            $table->double('spec_memory')->nullable();
            $table->integer('spec_storage')->nullable();
            $table->double('spec_screen_size')->nullable();
            $table->text('spec_others')->nullable();
            $table->json('bundle_with')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hardware');
    }
};
