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
        Schema::create('distinations', function (Blueprint $table) {
            $table->id();
            $table->string("distination");
            $table->unsignedBigInteger("link_id")->nullable();
            $table->double('persentage', 8, 2);
            $table->integer('distination_statistic_id')->nullable();
            $table->timestamps();

            $table->foreign('link_id')
                ->references('id')
                ->on('links')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
