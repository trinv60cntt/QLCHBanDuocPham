<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\ChiTietHD;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Components\NhanVienRecursive;

class AdminHoaDonController extends Controller
{
  public function __construct(
    HoaDon $hoadon,
    SanPham $sanpham,
    ChiTietHD $chitiethd,
    User $nhanvien
  ) {
    $this->hoadon = $hoadon;
    $this->chitiethd = $chitiethd;
    $this->sanpham = $sanpham;
    $this->nhanvien = $nhanvien;
  }

  public function index(Request $request)
  {
    $htmlOptionNhanVien = $this->getShipper($nhanvien_id_fk = '');
    if(!empty($request->query('ngayLap'))) {
      $search = DB::table('hoadon')->leftJoin('users', 'users.id','=', 'hoadon.nhanvien_id')->where('ngayLap','=', $request->ngayLap)->where('hoadon.deleted_at', NULL);
    }
    if(!empty($request->query('tinhTrang'))) {
      if($request->tinhTrang === 'zero') {
        $request->tinhTrang = 0;
      }
      $search = DB::table('hoadon')->leftJoin('users', 'users.id','=', 'hoadon.nhanvien_id')->where('tinhTrang','=', $request->tinhTrang)->where('hoadon.deleted_at', NULL);
    }
    if(!empty($request->query('nhanvien_id'))) {
      $search = DB::table('hoadon')->leftJoin('users', 'users.id','=', 'hoadon.nhanvien_id')->where('nhanvien_id','=', $request->nhanvien_id)->where('hoadon.deleted_at', NULL);
    }
    // 1 - 2
    if(!empty($request->query('ngayLap')) && !empty($request->query('tinhTrang'))) {
      $search = DB::table('hoadon')->leftJoin('users', 'users.id','=', 'hoadon.nhanvien_id')->where('tinhTrang','=', $request->tinhTrang)->where('ngayLap','=', $request->ngayLap)->where('hoadon.deleted_at', NULL);
    }
    // 1 - 3
    if(!empty($request->query('ngayLap')) && !empty($request->query('nhanvien_id'))) {
      $search = DB::table('hoadon')->leftJoin('users', 'users.id','=', 'hoadon.nhanvien_id')->where('ngayLap','=', $request->ngayLap)->where('nhanvien_id','=', $request->nhanvien_id)->where('hoadon.deleted_at', NULL);
    }
    // 2 - 3
    if(!empty($request->query('tinhTrang')) && !empty($request->query('nhanvien_id'))) {
      $search = DB::table('hoadon')->leftJoin('users', 'users.id','=', 'hoadon.nhanvien_id')->where('tinhTrang','=', $request->tinhTrang)->where('nhanvien_id','=', $request->nhanvien_id)->where('hoadon.deleted_at', NULL);
    }
    // 1 - 2 - 3
    if(!empty($request->query('ngayLap')) && !empty($request->query('tinhTrang')) && !empty($request->query('nhanvien_id'))) {
      $search = DB::table('hoadon')->leftJoin('users', 'users.id','=', 'hoadon.nhanvien_id')->where('tinhTrang','=', $request->tinhTrang)->where('ngayLap','=', $request->ngayLap)->where('nhanvien_id','=', $request->nhanvien_id)->where('hoadon.deleted_at', NULL);
    }
    if(!empty($search)) {
      $hoadons = $search->paginate(5);
    }
    else {
      $hoadons = DB::table('hoadon')->leftJoin('users', 'users.id','=', 'hoadon.nhanvien_id')->orderBy('hoadon.hoaDon_id', 'DESC')->where('hoadon.deleted_at', NULL)->paginate(5);
    }
    return view('admin.hoadon.index', compact('hoadons', 'htmlOptionNhanVien'));
  }

  public function edit($hoaDon_id) {
    $hoadon = $this->hoadon->find($hoaDon_id);
    $htmlOptionNhanVien = $this->getShipper($hoadon->nhanvien_id);
    return view('admin.hoadon.edit', compact('hoadon', 'htmlOptionNhanVien'));
  }

  public function getShipper($nhanvien_id_fk)
  {
    $data = $this->nhanvien->where('vaiTro_id', 7)->get();
    $recursiveNhanVien = new NhanVienRecursive($data);
    $htmlOptionNhanVien = $recursiveNhanVien->NhanvienRecursive($nhanvien_id_fk);
    return $htmlOptionNhanVien;
  }

  public function update(Request $request, $hoaDon_id) {
    try {
      DB::beginTransaction();
      $dataProductUpdate = [
        'nhanvien_id' => $request->nhanvien_id,
      ];
      switch ($request->tinhTrang)
      {
        case 0:
          $dataProductUpdate['tinhTrang'] = 0;
          break;
        case 1:
          $dataProductUpdate['tinhTrang'] = 1;
          break;
        case 2:
          $dataProductUpdate['tinhTrang'] = 2;
          break;
        case 3:
          $dataProductUpdate['tinhTrang'] = 3;
        break;
        default:
          $dataProductUpdate['tinhTrang'] = 4;
        break;
      }

      $this->hoadon->find($hoaDon_id)->update($dataProductUpdate);
      $hoadon = $this->hoadon->find($hoaDon_id);

      DB::commit();
      return redirect()->route('hoadons.index');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
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

  public function printDH($hoaDon_id) {
    $chitiethd = $this->chitiethd->find($hoaDon_id);
    $hoadon = $this->hoadon->find($hoaDon_id);  
    $order_d_by_id = DB::table('chitiethd')
    ->join('hoadon', 'chitiethd.hoaDon_id','=', 'hoadon.hoaDon_id')
    ->join('san_phams', 'chitiethd.sanPham_id','=', 'san_phams.sanPham_id')
    ->select('hoadon.*','chitiethd.*','san_phams.*')->where('chitiethd.hoaDon_id', $hoaDon_id)->get();

    // echo '<pre>';
    // print_r($order_d_by_id);
    // echo '</pre>';
    return view('admin.hoadon.printDH', compact('chitiethd', 'hoadon', 'order_d_by_id'));
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
