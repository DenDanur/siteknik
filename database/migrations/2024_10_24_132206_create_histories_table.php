<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->decimal('denda', 10, 2)->nullable();
            $table->integer('jumlah');
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('histories');
    }
};
