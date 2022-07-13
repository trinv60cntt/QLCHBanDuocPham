<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SanPhams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->bigIncrements('sanPham_id');
            $table->string('tenSP');
            $table->integer('soLuongTon');
            $table->string('giaNhap');
            $table->string('donGia');
            $table->string('donViTinh');
            $table->string('hinhAnh');
            $table->string('congDung');
            $table->date('ngaySanXuat');
            $table->date('hanSuDung');
            $table->boolean('banChay');
            $table->integer('NSX_id');
            $table->integer('danhMuc_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('san_phams');
    }
}
