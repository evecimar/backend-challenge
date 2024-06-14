<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fibonacci_queries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('value');
            $table->decimal('result', 30, 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fibonacci_queries');
    }
};
