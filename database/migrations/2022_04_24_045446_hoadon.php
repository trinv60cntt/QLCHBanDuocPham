<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hoadon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoadon', function (Blueprint $table) {
            $table->bigIncrements('hoaDon_id');
            $table->string('hoTenKH');
            $table->string('sdt');
            $table->string('diaChi');
            $table->string('email');
            $table->string('ghiChu')->nullable();
            $table->string('tongTien');
            $table->string('tinhTrang');
            // $table->integer('user_id')->nullable(); 
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
        Schema::dropIfExists('hoadon');
    }
}
