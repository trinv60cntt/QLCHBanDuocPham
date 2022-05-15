<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\HoaDon;
use App\Models\ChiTietHD;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KhachHangController extends Controller
{

  public function __construct(
    HoaDon $hoadon,
    ChiTietHD $chitiethd
  ) {
    $this->hoadon = $hoadon;
    $this->chitiethd = $chitiethd;
  }

  public function lichsu() {
    if(!Session::get('khachhang_id')) {
      return redirect('login-checkout')->with('error', 'Vui lòng đăng nhập để xem lịch sử đơn hàng');
    }
    else {
      $hoadons = HoaDon::where('khachhang_id', Session::get('khachhang_id'))->orderBy('hoaDon_id', 'DESC')->paginate(5);
      return view('home.khachhang.lichsu', compact('hoadons'));
    }
  }

  public function details($hoaDon_id) {
    if(!Session::get('khachhang_id')) {
      return redirect('login-checkout')->with('error', 'Vui lòng đăng nhập để xem chi tiết đơn hàng');
    }
    else {
      $chitiethd = $this->chitiethd->find($hoaDon_id);
      $hoadon = $this->hoadon->find($hoaDon_id);
      $order_d_by_id = DB::table('chitiethd')
      ->join('hoadon', 'chitiethd.hoaDon_id','=', 'hoadon.hoaDon_id')
      ->join('san_phams', 'chitiethd.sanPham_id','=', 'san_phams.sanPham_id')
      ->select('hoadon.*','chitiethd.*','san_phams.*')->where('chitiethd.hoaDon_id', $hoaDon_id)->get();
  
      return view('home.khachhang.details', compact('chitiethd', 'hoadon', 'order_d_by_id'));
    }
  }

  public function delete($hoaDon_id) {

    if(!Session::get('khachhang_id')) {
      return redirect('login-checkout')->with('error', 'Vui lòng đăng nhập để hủy đơn hàng');
    }
    else {
      try {
        $hoadon = $this->hoadon->find($hoaDon_id);

        $hoadon->update([
          'tinhTrang' => 0,
        ]);

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
}
