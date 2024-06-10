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
        Schema::create('tbl_cabang', function (Blueprint $table) {
            $table->increments('cabang_id');
            $table->string('cabang_nama');
            $table->string('cabang_slug');
            $table->text('cabang_alamat')->nullable();
            $table->string('cabang_kode')->nullable();
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
        Schema::dropIfExists('tbl_cabang');
    }
};
