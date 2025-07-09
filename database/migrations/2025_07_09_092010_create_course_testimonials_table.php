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
        Schema::create('course_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('occupation')->nullable();
            $table->text('message');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->string('photo')->nullable();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_testimonials');
    }
};
