<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Binhluan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binhluan', function (Blueprint $table) {
            $table->bigIncrements('binhLuan_id');
            $table->string('noiDung', 255);
			$table->string('ten');
            $table->timestamp('ngay');
			$table->tinyInteger('tinhTrang')->default(0);
            $table->integer('binhLuanCha_id')->default(0);
            $table->integer('sanPham_id');
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
        Schema::dropIfExists('binhluan');
    }
}
