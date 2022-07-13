<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;

class AdminKhachHangController extends Controller
{
  use StorageImageTrait;

  public function __construct(
    KhachHang $khachhang,
    NguoiDung $nguoidung
  ) {
    $this->khachhang = $khachhang;
    $this->nguoidung = $nguoidung;
  }

  public function index(Request $request)
  {
    if(!empty($request->query('tenKH'))) {
      $search = DB::table('khachhang')->where(DB::raw("concat(hoKH, ' ', tenKH)"), 'LIKE', "%". $request->tenKH. "%");
    }
    if(!empty($search)) {
      $khachhangs = $search->paginate(5);
    }
    else {
      $khachhangs = DB::table('khachhang')->orderBy('khachhang.khachhang_id', 'DESC')->where('khachhang.deleted_at', NULL)->paginate(5);
    }
    return view('admin.khachhang.index', compact('khachhangs'));
  }

  public function create()
  {
    return view('admin.khachhang.add');
  }

  public function store(Request $request)
  {
    $request->validate([
      'email' => 'unique:nguoidung'
    ], [
      'email.unique' => 'Email đã tồn tại',
    ]);
    try {
      DB::beginTransaction();
      $dataProductCreate = [
        'hoKH' => $request->hoKH,
        'tenKH' => $request->tenKH,
        'ngaySinh' => $request->ngaySinh,
        'diaChi' => $request->diaChi,
        'email' => $request->email,
        'password' => md5($request->matKhau),
        'sdt' => $request->sdt,
      ];
      if ($request->gioiTinh == 1) {
        $dataProductCreate['gioiTinh'] = 1;
      }
      else {
        $dataProductCreate['gioiTinh'] = 0;
      }
      $get_image = $request->file('hinhAnh');
 
      if($get_image) {
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99). '.' . $get_image->getClientOriginalExtension();
  
        $get_image->move('uploads/khachhang', $new_image);
        $dataProductCreate['hinhAnh'] = $new_image;
      }
      $hoTenKH = $request->hoKH . ' ' . $request->tenKH;

      $nguoidung = array();
      $nguoidung['name'] = $hoTenKH;
      $nguoidung['email'] = $request->email;
      $nguoidung['is_admin'] = 0;
      $nguoidung['is_online'] = 0;
      $nguoidung['last_activity'] = now();
      DB::table('nguoidung')->insertGetId($nguoidung);
      $khachhang = $this->khachhang->create($dataProductCreate);

      DB::commit();
      return redirect()->route('khachhangs.index')->with('success', 'Thêm mới khách hàng thành công');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function edit($khachhang_id) {
    $khachhang = $this->khachhang->find($khachhang_id);

    return view('admin.khachhang.edit', compact('khachhang'));
  }

  public function update(Request $request, $khachhang_id) {
    try {
      DB::beginTransaction();
      $dataProductUpdate = [
        'hoKH' => $request->hoKH,
        'tenKH' => $request->tenKH,
        'ngaySinh' => $request->ngaySinh,
        'diaChi' => $request->diaChi,
        'email' => $request->email,
        'password' => md5($request->password),
        'sdt' => $request->sdt,
      ];
      if ($request->gioiTinh == 1) {
        $dataProductUpdate['gioiTinh'] = 1;
      }
      else {
        $dataProductUpdate['gioiTinh'] = 0;
      }
      $get_image = $request->file('hinhAnh');

      if($get_image) {
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99). '.' . $get_image->getClientOriginalExtension();

        $get_image->move('uploads/khachhang', $new_image);
        $dataProductUpdate['hinhAnh'] = $new_image;
      }
      $this->khachhang->find($khachhang_id)->update($dataProductUpdate);
      $khachhang = $this->khachhang->find($khachhang_id);

      DB::commit();
      return redirect()->route('khachhangs.index')->with('success', 'Cập nhật thông tin khách hàng thành công');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function delete($khachhang_id) {
    try {
      $nguoidung = $this->nguoidung->get();
      $khachhang = $this->khachhang->find($khachhang_id);

      foreach($nguoidung as $nd) {
        if ($khachhang->email == $nd->email) {
          $this->nguoidung->find($nd->id)->delete();
        }
      }
      $khachhang->delete();
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

  public function search(Request $request) {
    $keywords = $request->keywords_submit;

    $khachhangs = $this->khachhang->latest()->paginate(5);

    $search_customer = KhachHang::where(DB::raw("concat(hoKH, ' ', tenKH)"), 'LIKE', "%". $keywords. "%")->get();

    return view('admin.khachhang.search', compact('khachhangs', 'search_customer'));
  }

  public function details($khachhang_id) {
    $khachhang = $this->khachhang->find($khachhang_id);
    return view('admin.khachhang.details', compact('khachhang'));
  }
}
