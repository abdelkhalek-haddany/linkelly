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
            $table->string('country');
            $table->string('device');
            $table->string('browser');
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
