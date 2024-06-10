<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pengajuan', function (Blueprint $table) {
            $table->increments('pengajuan_id');
            $table->string('pengajuan_nama_barang');
            $table->string('pengajuan_jenis_barang');
            $table->string('pengajuan_tujuan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pengajuan');
    }
};
