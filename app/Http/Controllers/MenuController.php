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

    if (isset($_GET['sort_by'])) {
      $sort_by = $_GET['sort_by'];
  
      if($sort_by == 'giam_dan') {
        $category_by_id = SanPham::orderBy('donGia', 'DESC')->paginate(12)->appends(request()->query());
      } else if($sort_by == 'tang_dan') {
        $category_by_id = SanPham::orderBy('donGia', 'ASC')->paginate(12)->appends(request()->query());
      } else if($sort_by == 'kytu_za') {
        $category_by_id = SanPham::orderBy('tenSP', 'DESC')->paginate(12)->appends(request()->query());
      } else if($sort_by == 'kytu_az') {
        $category_by_id = SanPham::orderBy('tenSP', 'ASC')->paginate(12)->appends(request()->query());
      }
      else {
        $category_by_id = SanPham::orderBy('sanpham_id', 'DESC')->get();
      }
    }
    else {
      $category_by_id = SanPham::orderBy('sanpham_id', 'DESC')->get();
    }

    return view('home.menu.index', compact('sanphams', 'categorys', 'category_by_id'));
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

    // $category_by_id = $danhMuc_id;
    if (isset($_GET['sort_by'])) {
      $sort_by = $_GET['sort_by'];
  
      if($sort_by == 'giam_dan') {
        // dd('1');
        $category_by_id = SanPham::with('DanhMuc')->where('danhMuc_id', $danhMuc_id)
        ->orderBy('donGia', 'DESC')->paginate(6)->appends(request()->query());
      } else if($sort_by == 'tang_dan') {
        $category_by_id = SanPham::with('DanhMuc')->where('danhMuc_id', $danhMuc_id)
        ->orderBy('donGia', 'ASC')->paginate(6)->appends(request()->query());
      } else if($sort_by == 'kytu_za') {
        $category_by_id = SanPham::with('DanhMuc')->where('danhMuc_id', $danhMuc_id)
        ->orderBy('tenSP', 'DESC')->paginate(6)->appends(request()->query());
      } else if($sort_by == 'kytu_az') {
        $category_by_id = SanPham::with('DanhMuc')->where('danhMuc_id', $danhMuc_id)
        ->orderBy('tenSP', 'ASC')->paginate(6)->appends(request()->query());
      }
      else {
        $category_by_id = SanPham::with('DanhMuc')->where('danhMuc_id', $danhMuc_id)->orderBy('sanpham_id', 'DESC')->get();
      }
    }
    else {
      $category_by_id = SanPham::with('DanhMuc')->where('danhMuc_id', $danhMuc_id)->orderBy('sanpham_id', 'DESC')->get();
    }
    // dd($category_by_id);
    return view('home.menu.list', compact('sanphams', 'categorys', 'category_by_id'));
  }


  public function search(Request $request) {
    $keywords = $request->keywords_submit;

    $sanphams = $this->sanpham->latest()->get();
    $categorys = Danhmuc::where('danhMucCha_id', 0)->get();

    $search_product = DB::table('san_phams')->where('tenSP','like','%'. $keywords .'%')->get();

    return view('home.menu.search', compact('sanphams', 'categorys'))->with('search_product',$search_product);
  }
}
