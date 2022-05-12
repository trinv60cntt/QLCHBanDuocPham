<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateVaiTroSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('vai_tros')->insert([
      ['tenVT' => 'ADMIN', 'moTa' => 'Quản trị hệ thống'],
      ['tenVT' => 'NHANVIENBANHANG', 'moTa' => 'Nhân viên bán hàng'],
      ['tenVT' => 'SHIPPER', 'moTa' => 'Nhân viên giao hàng'],
    ]);
  }
}
