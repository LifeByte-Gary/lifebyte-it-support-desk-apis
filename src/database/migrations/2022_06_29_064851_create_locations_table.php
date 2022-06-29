<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company');
            $table->string('country');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};