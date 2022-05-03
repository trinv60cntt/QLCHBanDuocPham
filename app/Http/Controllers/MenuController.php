<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\NhaSanXuat;
use Illuminate\Support\Facades\DB;

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

  public function index()
  {
    $sanphams = $this->sanpham->latest()->get();
    $categorys = Danhmuc::where('danhMucCha_id', 0)->get();

    return view('home.menu.index', compact('sanphams', 'categorys'));
  }


  public function details($sanPham_id, Request $request) {
    // $sanpham = $this->sanpham->find($sanPham_id);
    $sanpham = $this->sanpham->find($sanPham_id);
    return view('home.menu.details', compact('sanpham'));
  }

  public function getCategory($danhMuc_id)
  {
    $categorys = Danhmuc::where('danhMucCha_id', 0)->get();
    $sanphams = SanPham::where('danhMuc_id', $danhMuc_id)->get();
    return view('home.menu.list', compact('sanphams', 'categorys'));
  }


  public function search(Request $request) {
    $keywords = $request->keywords_submit;

    $sanphams = $this->sanpham->latest()->get();
    $categorys = Danhmuc::where('danhMucCha_id', 0)->get();

    $search_product = DB::table('san_phams')->where('tenSP','like','%'. $keywords .'%')->get();

    return view('home.menu.search', compact('sanphams', 'categorys'))->with('search_product',$search_product);
  }
}
