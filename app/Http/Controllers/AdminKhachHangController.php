<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;

class AdminKhachHangController extends Controller
{
  use StorageImageTrait;

  public function __construct(
    KhachHang $khachhang
  ) {
    $this->khachhang = $khachhang;
  }

  public function index()
  {
    $khachhangs = $this->khachhang->latest()->paginate(5);
    return view('admin.khachhang.index', compact('khachhangs'));
  }

  public function create()
  {
    return view('admin.khachhang.add');
  }

  public function store(Request $request)
  {
    try {
      DB::beginTransaction();
      $dataProductCreate = [
        'hoKH' => $request->hoKH,
        'tenKH' => $request->tenKH,
        'ngaySinh' => $request->ngaySinh,
        'diaChi' => $request->diaChi,
        'email' => $request->email,
        'password' => md5($request->password),
        'sdt' => $request->sdt,
      ];
      if ($request->gioiTinh == 1) {
        $dataProductCreate['gioiTinh'] = 1;
      }
      else {
        $dataProductCreate['gioiTinh'] = 0;
      }
      $dataUploadFeatureImage = $this->storageTraitUpload($request, 'hinhAnh', 'khachhang');
      if (!empty($dataUploadFeatureImage)) {
        $dataProductCreate['hinhAnh'] = $dataUploadFeatureImage['file_name'];
      }
      $khachhang = $this->khachhang->create($dataProductCreate);

      DB::commit();
      return redirect()->route('khachhangs.index');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function delete($khachhang_id) {
    try {
      $this->khachhang->find($khachhang_id)->delete();
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
