<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nhanvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->bigIncrements('nhanvien_id');
            $table->string('hotenNV');
            $table->boolean('gioiTinh');
            $table->date('ngaySinh');
            $table->string('diaChi');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('sdt');
            $table->string('hinhAnh');
            $table->rememberToken();
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
        Schema::dropIfExists('nhanvien');
    }
}
