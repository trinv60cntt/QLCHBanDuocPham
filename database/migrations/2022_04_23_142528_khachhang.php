<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Khachhang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhang', function (Blueprint $table) {
			$table->bigIncrements('khachhang_id');
            $table->string('hoKH');
            $table->string('tenKH');
            $table->boolean('gioiTinh');
            $table->date('ngaySinh');
            $table->string('diaChi');
            $table->string('email');
            $table->string('password');
            $table->string('sdt');
            $table->string('hinhAnh');
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
        Schema::dropIfExists('khachhang');
    }
}
