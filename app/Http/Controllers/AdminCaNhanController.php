<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VaiTro;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\StorageImageTrait;
use App\Components\VaiTroRecursive;
use Illuminate\Support\Facades\Auth;

class AdminCaNhanController extends Controller
{
  use StorageImageTrait;

  private $nhanvien;
  public function __construct(User $nhanvien, VaiTro $vaitro)
  {
    $this->nhanvien = $nhanvien;
    $this->vaitro = $vaitro;
  }

  public function index()
  {
    $id = Auth::user()->id;
    $nhanvien = $this->nhanvien->find($id);
    return view('admin.canhan.index', compact('nhanvien'));
  }

  public function edit() {
    $id = Auth::user()->id;
    $nhanvien = $this->nhanvien->find($id);
    
    return view('admin.canhan.edit', compact('nhanvien'));
  }

  public function update(Request $request) {
    $id = Auth::user()->id;
    try {
      DB::beginTransaction();
      $dataProductUpdate = [
        'hotenNV' => $request->hotenNV,
        'ngaySinh' => $request->ngaySinh,
        'diaChi' => $request->diaChi,
        'email' => $request->email,
        // 'password' => Hash::make($request->password),
        'sdt' => $request->sdt,
        // 'vaiTro_id' => $request->vaiTro_id,
      ];
      if ($request->gioiTinh == 1) {
        $dataProductUpdate['gioiTinh'] = 1;
      }
      else {
        $dataProductUpdate['gioiTinh'] = 0;
      }
      $dataUploadFeatureImage = $this->storageTraitUpload($request, 'hinhAnh', 'nhanvien');
      if (!empty($dataUploadFeatureImage)) {
        $dataProductUpdate['hinhAnh'] = $dataUploadFeatureImage['file_name'];
      }
      $this->nhanvien->find($id)->update($dataProductUpdate);
      $nhanvien = $this->nhanvien->find($id);

      DB::commit();
      return redirect()->route('canhans.index');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function doimatkhau() {
    return view('admin.canhan.doimatkhau');
  }

  public function luuMatKhau(Request $request) {
    $id = Auth::user()->id;
    $nhanvien_password = Auth::user()->password;

    $oldPass = $request->oldPass;
    $newPass = $request->newPass;
    $againPass = $request->againPass;

    if (!(Hash::check($oldPass, $nhanvien_password))) {
      return back()->withInput()->withErrors(['oldPass' => 'Mật khẩu cũ không đúng']);
    }

    if (Hash::check($newPass, $nhanvien_password)) {
      return back()->withInput()->withErrors(['newPass' => 'Mật khẩu mới phải khác mật khẩu cũ']);
    }

    if ($newPass != $againPass) {
      return back()->withInput()->withErrors(['againPass' => 'Mật khẩu nhập lại không khớp']);
    }

    $nhanvien = $this->nhanvien->find($id);
    $nhanvien->update([
      'password' => Hash::make($request->newPass),
    ]);

    return redirect()->route('canhans.index');
  }
}
