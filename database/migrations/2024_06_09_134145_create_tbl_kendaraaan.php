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
        Schema::create('tbl_kendaraan', function (Blueprint $table) {
            $table->increments('kendaraan_id');
            $table->string('kendaraan_nama');
            $table->string('kendaraan_slug');
            $table->string('kendaraan_plat')->nullable();
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
        Schema::dropIfExists('tbl_kendaraan');
    }
};
