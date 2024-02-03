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
        Schema::create('distination_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("distination_id");
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('platform')->nullable();
            $table->string('is_robot')->nullable();
            $table->string('is_desktop')->nullable();
            $table->string('is_tablet')->nullable();
            $table->string('is_mobile')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('languages')->nullable();
            $table->timestamps();

            $table->foreign('distination_id')
                ->references('id')
                ->on('distinations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distination_statistics');
    }
};
