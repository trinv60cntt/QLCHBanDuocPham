<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VaiTro;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\StorageImageTrait;
use App\Components\VaiTroRecursive;


class AdminNhanVienController extends Controller
{
  use StorageImageTrait;

  private $nhanvien;
  public function __construct(User $nhanvien, VaiTro $vaitro, NguoiDung $nguoidung)
  {
    $this->nhanvien = $nhanvien;
    $this->vaitro = $vaitro;
    $this->nguoidung = $nguoidung;
  }

  public function index(Request $request)
  {
    $htmlOption = $this->getVaiTro($vaiTro_id_fk = '');
    if(!empty($request->query('tenNV'))) {
      $search = DB::table('users')->leftJoin('vai_tros', 'vai_tros.vaiTro_id','=', 'users.vaiTro_id')->where('hotenNV','like','%'. $request->tenNV .'%')->where('users.deleted_at', NULL);
    }
    if(!empty($request->query('vaiTro_id'))) {
      $search = DB::table('users')->leftJoin('vai_tros', 'vai_tros.vaiTro_id','=', 'users.vaiTro_id')->where('users.vaiTro_id','=', $request->vaiTro_id)->where('users.deleted_at', NULL);
    }
    if(!empty($request->query('tenNV')) && !empty($request->query('vaiTro_id'))) {
      $search = DB::table('users')->leftJoin('vai_tros', 'vai_tros.vaiTro_id','=', 'users.vaiTro_id')->where('hotenNV','like','%'. $request->tenNV .'%')->where('users.vaiTro_id','=', $request->vaiTro_id)->where('users.deleted_at', NULL);
    }
    if(!empty($search)) {
      $nhanviens = $search->paginate(5);
    }
    else {
      $nhanviens = DB::table('users')->join('vai_tros', 'vai_tros.vaiTro_id','=', 'users.vaiTro_id')->orderBy('users.created_at', 'DESC')->where('users.deleted_at', NULL)->paginate(5);
    }

    return view('admin.nhanvien.index', compact('nhanviens', 'htmlOption'));
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
    $request->validate([
      'email' => 'unique:nguoidung'
    ], [
      'email.unique' => 'Email đã tồn tại',
    ]);
    try {
      DB::beginTransaction();
      $dataProductCreate = [
        'hotenNV' => $request->hotenNV,
        'ngaySinh' => $request->ngaySinh,
        'diaChi' => $request->diaChi,
        'email' => $request->email,
        'password' => Hash::make($request->matKhau),
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
      $get_image = $request->file('hinhAnh');
 
      if($get_image) {
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
  
        $get_image->move('uploads/nhanvien', $new_image);
        $dataProductCreate['hinhAnh'] = $new_image;
      }
      $nhanvien = $this->nhanvien->create($dataProductCreate);

      $nguoidung = array();
      $nguoidung['name'] = $request->hotenNV;
      $nguoidung['email'] = $request->email;
      $nguoidung['is_admin'] = 1;
      $nguoidung['is_online'] = 0;
      $nguoidung['last_activity'] = now();
      $this->nguoidung->create($nguoidung);

      DB::commit();
      return redirect()->route('nhanviens.index')->with('success', 'Thêm mới nhân viên thành công');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function edit($id) {
    $nhanvien = $this->nhanvien->find($id);
    $htmlOptionVaiTro = $this->getVaiTro($nhanvien->vaiTro_id);
    
    return view('admin.nhanvien.edit', compact('nhanvien', 'htmlOptionVaiTro'));
  }

  public function update(Request $request, $id) {
    try {
      DB::beginTransaction();
      $dataProductUpdate = [
        'hotenNV' => $request->hotenNV,
        'ngaySinh' => $request->ngaySinh,
        'diaChi' => $request->diaChi,
        'email' => $request->email,
        // 'password' => Hash::make($request->password),
        'sdt' => $request->sdt,
        'vaiTro_id' => $request->vaiTro_id,
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
        $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();

        $get_image->move('uploads/nhanvien', $new_image);
        $dataProductUpdate['hinhAnh'] = $new_image;
      }
      $this->nhanvien->find($id)->update($dataProductUpdate);
      $nhanvien = $this->nhanvien->find($id);

      DB::commit();
      return redirect()->route('nhanviens.index')->with('success', 'Cập nhật thông tin nhân viên thành công');
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
    }
  }

  public function delete($id) {
    try {
      $nguoidung = $this->nguoidung->get();
      $nhanvien = $this->nhanvien->find($id);

      foreach($nguoidung as $nd) {
        if ($nhanvien->email == $nd->email) {
          $this->nguoidung->find($nd->id)->delete();
        }
      }
      $nhanvien->delete();

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
    // dd($request->email);
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

  public function details($id) {
    $nhanvien = $this->nhanvien->find($id);
    return view('admin.nhanvien.details', compact('nhanvien'));
  }
}
