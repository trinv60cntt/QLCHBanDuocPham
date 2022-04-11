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
      ['tenVT' => 'admin', 'moTa' => 'Quản trị hệ thống'],
      ['tenVT' => 'nhanvien', 'moTa' => 'Nhân viên'],
    ]);
  }
}
