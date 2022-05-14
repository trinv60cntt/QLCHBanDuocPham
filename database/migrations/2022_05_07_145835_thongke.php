<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Thongke extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongke', function (Blueprint $table) {
            $table->bigIncrements('thongKe_id');
            $table->date('hoaDonNgay');
            $table->bigInteger('tongTien');
            $table->integer('soLuongSP');
            $table->integer('tongHD');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongke');
    }
}