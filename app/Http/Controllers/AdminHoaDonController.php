<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\ChiTietHD;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class AdminHoaDonController extends Controller
{
  public function __construct(
    HoaDon $hoadon,
    SanPham $sanpham,
    ChiTietHD $chitiethd
  ) {
    $this->hoadon = $hoadon;
    $this->chitiethd = $chitiethd;
    $this->sanpham = $sanpham;
  }

  public function index()
  {
    $hoadons = $this->hoadon->latest()->paginate(5);
    return view('admin.hoadon.index', compact('hoadons'));
  }

  public function details($hoaDon_id) {
    $chitiethd = $this->chitiethd->find($hoaDon_id);
    $hoadon = $this->hoadon->find($hoaDon_id);  
    $order_d_by_id = DB::table('chitiethd')
    ->join('hoadon', 'chitiethd.hoaDon_id','=', 'hoadon.hoaDon_id')
    ->join('san_phams', 'chitiethd.sanPham_id','=', 'san_phams.sanPham_id')
    ->select('hoadon.*','chitiethd.*','san_phams.*')->where('chitiethd.hoaDon_id', $hoaDon_id)->get();

    // echo '<pre>';
    // print_r($order_d_by_id);
    // echo '</pre>';
    return view('admin.hoadon.details', compact('chitiethd', 'hoadon', 'order_d_by_id'));
  }

  public function delete($hoaDon_id) {
    try {
      $this->hoadon->find($hoaDon_id)->delete();
      return response()->json([
        'code' => 200,
        'message' => 'success'
      ], 200);

    } catch (\Exception $exception) {
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
      return response()->json([
        'code' => 500,
        'message' => 'fail'
      ], 500);
    }
  }
}
