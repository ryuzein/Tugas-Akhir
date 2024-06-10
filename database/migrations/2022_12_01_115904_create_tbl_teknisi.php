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
        Schema::create('tbl_teknisi', function (Blueprint $table) {
            $table->increments('teknisi_id');
            $table->string('teknisi_nama');
            $table->string('teknisi_slug');
            $table->text('teknisi_alamat')->nullable();
            $table->string('teknisi_notelp')->nullable();
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
        Schema::dropIfExists('tbl_teknisi');
    }
};
