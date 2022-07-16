<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\HoaDon;
use App\Models\ChiTietHD;
use App\Models\KhachHang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
  use StorageImageTrait;

  public function __construct(
    HoaDon $hoadon,
    ChiTietHD $chitiethd,
    KhachHang $khachhang
  ) {
    $this->hoadon = $hoadon;
    $this->chitiethd = $chitiethd;
    $this->khachhang = $khachhang;
  }

  public function index()
  {
    // dd(Session::get('khachhang_id'));
    $khachhang_id = Session::get('khachhang_id');
    dd($khachhang_id);
    $khachhang = $this->khachhang->find($khachhang_id);
    return view('home.khachhang.index', compact('khachhang'));
  }

  public function edit() {
    $khachhang_id = Session::get('khachhang_id');
    $khachhang = $this->khachhang->find($khachhang_id);

    return view('home.khachhang.edit', compact('khachhang'));
  }

  public function update(Request $request) {
    $khachhang_id = Session::get('khachhang_id');
    try {
      DB::beginTransaction();
      $dataProductUpdate = [
        'hoKH' => $request->hoKH,
        'tenKH' => $request->tenKH,
        'ngaySinh' => $request->ngaySinh,
        'diaChi' => $request->diaChi,
        'email' => $request->email,
        'sdt' => $request->sdt,
      ];
      if ($request->gioiTinh == 1) {
        $dataProductUpdate['gioiTinh'] = 1;
      }
      else {
        $dataProductUpdate['gioiTinh'] = 0;
      }
      $dataUploadFeatureImage = $this->storageTraitUpload($request, 'hinhAnh', 'khachhang');
      if (!empty($dataUploadFeatureImage)) {
        $dataProductUpdate['hinhAnh'] = $dataUploadFeatureImage['file_name'];
        Session::put('hinhAnh', $dataUploadFeatureImage['file_name']);
      }
      $this->khachhang->find($khachhang_id)->update($dataProductUpdate);
      $khachhang = $this->khachhang->find($khachhang_id);

      DB::commit();
      Session::put('hoKH', $request->hoKH);
      Session::put('tenKH', $request->tenKH);
      return redirect()->route('khachhang.index')->with('success', 'Cập nhật thông tin cá nhân thành công');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
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

  
  public function doimatkhau() {
    return view('home.khachhang.doimatkhau');
  }

  public function luuMatKhau(Request $request) {
    $khachhang_id = Session::get('khachhang_id');
    $khachhang_password = Session::get('password');

    $oldPass = $request->oldPass;
    $newPass = $request->newPass;
    $againPass = $request->againPass;

    if (!(Hash::check($oldPass, $khachhang_password))) {
      return back()->withInput()->withErrors(['oldPass' => 'Mật khẩu cũ không đúng']);
    }

    if (Hash::check($newPass, $khachhang_password)) {
      return back()->withInput()->withErrors(['newPass' => 'Mật khẩu mới phải khác mật khẩu cũ']);
    }

    // if ($newPass != $againPass) {
    //   return back()->withInput()->withErrors(['againPass' => 'Mật khẩu nhập lại không khớp']);
    // }

    $khachhang = $this->khachhang->find($khachhang_id);
    $khachhang->update([
      'password' => Hash::make($request->newPass),
    ]);

    return redirect()->route('khachhang.index')->with('success', 'Đổi mật khẩu thành công');
  }
}
