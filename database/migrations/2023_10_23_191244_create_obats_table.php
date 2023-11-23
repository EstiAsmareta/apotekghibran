<?php

use App\Models\admin;
use App\Models\rak;
use App\Models\User;
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
        Schema::create('obats', function (Blueprint $table) {
            $table->string('id',6)->primary();
            $table->string('nama_obat');
            $table->string('nama_produsen');
            $table->integer('stok');
            $table->date('tgl_kadaluarsa');
            $table->string('dosis');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->timestamps();
            $table->foreignIdFor(rak::class);
            $table->foreignIdFor(User::class);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
