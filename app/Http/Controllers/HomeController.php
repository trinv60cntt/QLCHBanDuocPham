<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;

class HomeController extends Controller
{
  public function index() { 
    $sanphams = SanPham::where('banChay', 1)->latest()->take(6)->get();
    $sanPhamCovid = SanPham::where('danhMuc_id', 11)->latest()->take(6)->get();
    
    return view('home.home', compact('sanphams', 'sanPhamCovid'));
  }

  // public function details() {
  //   return view('home.detailsSanPham');
  // }

  // public function giohang() {
  //   return view('home.indexGioHang');
  // }
}
