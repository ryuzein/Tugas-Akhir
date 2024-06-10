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
        Schema::create('tbl_suppliermasuk', function (Blueprint $table) {
            $table->increments('suppliermasuk_id');
            $table->string('suppliermasuk_kode');
            $table->string('kendaraan_kode');
            $table->string('suppliersopir_id');
            $table->string('suppliermasuk_tanggal');
            $table->string('suppliermasuk_jumlah');
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
        Schema::dropIfExists('tbl_suppliermasuk');
    }
};
