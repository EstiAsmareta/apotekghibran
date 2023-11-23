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
        Schema::create('raks', function (Blueprint $table) {
            $table->id();
            $table->string('rak', 1);
            $table->integer('no_rak', );
            $table->timestamps();
            $table->unique(['rak', 'no_rak']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raks');
    }
};
