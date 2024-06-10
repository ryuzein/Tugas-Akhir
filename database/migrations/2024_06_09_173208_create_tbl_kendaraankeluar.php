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
        Schema::create('tbl_kendaraankeluar', function (Blueprint $table) {
            $table->increments('bkb_id');
            $table->string('bkb_kode');
            $table->string('kendaraan_kode');
            $table->string('bkb_tanggal');
            $table->string('bkb_tujuan')->nullable();
            $table->string('bkb_jumlah');
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
        Schema::dropIfExists('tbl_kendaraankeluar');
    }
};
