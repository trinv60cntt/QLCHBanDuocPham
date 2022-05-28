<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhanVien;
use App\Models\VaiTro;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\StorageImageTrait;
use App\Components\VaiTroRecursive;


class AdminNhanVienController extends Controller
{
  use StorageImageTrait;

  private $nhanvien;
  public function __construct(NhanVien $nhanvien, VaiTro $vaitro)
  {
    $this->nhanvien = $nhanvien;
    $this->vaitro = $vaitro;
  }

  public function index()
  {
    $nhanviens = $this->nhanvien->paginate(5);
    return view('admin.nhanvien.index', compact('nhanviens'));
  }

  public function create()
  {
    $htmlOptionVaiTro = $this->getVaiTro($vaiTro_id_fk = '');
    return view('admin.nhanvien.add', compact('htmlOptionVaiTro'));
  }

  public function getVaiTro($vaiTro_id_fk)
  {
    $data = $this->vaitro->all();
    $recursiveVaiTro = new VaiTroRecursive($data);
    $htmlOptionVaiTro = $recursiveVaiTro->VaiTroRecursive($vaiTro_id_fk);
    return $htmlOptionVaiTro;
  }

  public function store(Request $request)
  {
    try {
      DB::beginTransaction();
      $dataProductCreate = [
        'hotenNV' => $request->hotenNV,
        'ngaySinh' => $request->ngaySinh,
        'diaChi' => $request->diaChi,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'sdt' => $request->sdt,
        'vaiTro_id' => $request->vaiTro_id,
      ];
      // dd($request);
      if ($request->gioiTinh == 1) {
        $dataProductCreate['gioiTinh'] = 1;
      }
      else {
        $dataProductCreate['gioiTinh'] = 0;
      }
      $dataUploadFeatureImage = $this->storageTraitUpload($request, 'hinhAnh', 'nhanvien');
      if (!empty($dataUploadFeatureImage)) {
        $dataProductCreate['hinhAnh'] = $dataUploadFeatureImage['file_name'];
      }
      $nhanvien = $this->nhanvien->create($dataProductCreate);

      DB::commit();
      return redirect()->route('nhanviens.index');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function edit($nhanvien_id) {
    $nhanvien = $this->nhanvien->find($nhanvien_id);
    $htmlOptionVaiTro = $this->getVaiTro($nhanvien->vaiTro_id);
    
    return view('admin.nhanvien.edit', compact('nhanvien', 'htmlOptionVaiTro'));
  }

  public function update(Request $request, $nhanvien_id) {
    try {
      DB::beginTransaction();
      $dataProductUpdate = [
        'hotenNV' => $request->hotenNV,
        'ngaySinh' => $request->ngaySinh,
        'diaChi' => $request->diaChi,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'sdt' => $request->sdt,
        'vaiTro_id' => $request->vaiTro_id,
      ];
      if ($request->gioiTinh == 1) {
        $dataProductUpdate['gioiTinh'] = 1;
      }
      else {
        $dataProductUpdate['gioiTinh'] = 0;
      }
      $dataUploadFeatureImage = $this->storageTraitUpload($request, 'hinhAnh', 'nhanvien');
      if (!empty($dataUploadFeatureImage)) {
        $dataProductCreate['hinhAnh'] = $dataUploadFeatureImage['file_name'];
      }
      $this->nhanvien->find($nhanvien_id)->update($dataProductUpdate);
      $nhanvien = $this->nhanvien->find($nhanvien_id);

      DB::commit();
      return redirect()->route('nhanviens.index');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function delete($nhanvien_id) {
    try {
      $this->nhanvien->find($nhanvien_id)->delete();
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

    $nhanviens = $this->nhanvien->latest()->paginate(5);

    $search_staff = DB::table('nhanvien')->where('hotenNV','like','%'. $keywords .'%')->get();

    return view('admin.nhanvien.search', compact('nhanviens', 'search_staff'));
  }

  public function loginAdmin()
  {
    if (auth()->check()) {
      return view('admin.home');
    }
    return view('login');
  }

  public function postLoginAdmin(Request $request)
  {
    // dd($request->has('remember_me'));
    $remember = $request->has('remember_me') ? true : false;
    // dd(bcrypt($request->password));
    if (auth()->attempt([
      'email' => $request->email,
      'password' => $request->password
    ], $remember)) {
      return view('admin.home');
    } else {
      return back()->withInput()->with('error', '• Tài khoản hoặc mật khẩu chưa đúng');
    }
    // dd($request->all());
  }

  public function details($nhanvien_id) {
    $nhanvien = $this->nhanvien->find($nhanvien_id);
    return view('admin.nhanvien.details', compact('nhanvien'));
  }
}
