<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

  public function __construct(
    SanPham $sanpham
  ) {
    $this->sanpham = $sanpham;
  }

  public function index() {
    $sanPhamCovid = SanPham::where('danhMuc_id', 11)->latest()->take(6)->get();

    return view('home.home', compact('sanPhamCovid'));
  }

  public function autocomplete_ajax(Request $request) {
    $data = $request->all();

    if($data['query']) {
      $sanpham = SanPham::where('tenSP','LIKE','%'.$data['query'].'%')->get();

      $output = '<ul style="display:block; position:relative">';

      foreach($sanpham as $key => $val) {
        $output .= '
        <div class="flex"><i class="fas fa-search"></i><li class="li_search_ajax cursor-pointer">'.$val->tenSP.'</li></div>
        ';
      }

      $output .= '</ul>';
      echo $output;
    }
  }

}
