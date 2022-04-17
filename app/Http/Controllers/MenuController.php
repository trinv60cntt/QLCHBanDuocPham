<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\NhaSanXuat;

class MenuController extends Controller
{
  private $danhmuc;
  public function __construct(
      DanhMuc $danhmuc,
      SanPham $sanpham,
      NhaSanXuat $nhasanxuat
    ) {
      $this->danhmuc = $danhmuc;
      $this->sanpham = $sanpham;
      $this->nhasanxuat = $nhasanxuat;
    }

  public function details($sanPham_id, Request $request) {
    // $sanpham = $this->sanpham->find($sanPham_id);
    $sanpham = $this->sanpham->find($sanPham_id);
    return view('home.menu.details', compact('sanpham'));
  }

//   public function giohang() {
//     return view('home.indexGioHang');
//   }
}
