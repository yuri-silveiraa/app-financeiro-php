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
        Schema::create('expensives', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('category');
            $table->boolean('type');
            $table->date('date');
            $table->decimal('value', 10, 2);
            $table->boolean('paid');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expensives');
    }
};
