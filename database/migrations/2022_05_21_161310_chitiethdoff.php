<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Chitiethdoff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitiethdoff', function (Blueprint $table) {
            $table->bigIncrements('chiTietHDOff_id');
            $table->integer('hoaDon_id');
            $table->integer('sanPham_id');
            $table->integer('soLuong');
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
        Schema::dropIfExists('chitiethdoff');
    }
}
