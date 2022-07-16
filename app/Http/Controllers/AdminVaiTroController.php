<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaiTro;
use App\Models\Quyen;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;

class AdminVaiTroController extends Controller
{
  use StorageImageTrait;

  public function __construct(
    VaiTro $vaitro,
    Quyen $quyen
  ) {
    $this->vaitro = $vaitro;
    $this->quyen = $quyen;
  }

  public function index()
  {
    $vaitros = $this->vaitro->latest()->paginate(5);
    return view('admin.vaitro.index', compact('vaitros'));
  }

  public function create()
  {
    $quyenCha = $this->quyen->where('parent_id', 0)->get();
    // dd($quyenCha);
    return view('admin.vaitro.add', compact('quyenCha'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'tenVT' => 'unique:vai_tros'
    ], [
      'tenVT.unique' => 'Mã nhóm nhân viên đã tồn tại',
    ]);

    $this->vaitro->create([
      'tenVT' => $request->tenVT,
      'moTa' => $request->moTa,
    ]);

    // $role->quyens()->attach($request->quyen_id);

    
    return redirect()->route('vaitros.index')->with('success', 'Thêm mới nhóm nhân viên thành công');
  }

  public function edit($vaiTro_id)
  {
    $quyenCha = $this->quyen->where('parent_id', 0)->get();
    $vaitro = $this->vaitro->find($vaiTro_id);
    $quyensChecked = $vaitro->quyens;
    return view('admin.vaitro.edit', compact('quyenCha', 'vaitro', 'quyensChecked'));
  }

  public function update(Request $request, $vaiTro_id)
  {
    $vaitro = $this->vaitro->get();
    foreach($vaitro as $item) {
      if($vaiTro_id != $item->vaiTro_id && $item->tenVT == $request->tenVT) {
        return back()->withInput()->with('error', 'Mã nhóm nhân viên đã tồn tại');
      }
    }

    $role = $this->vaitro->find($vaiTro_id);
    $role->update([
      'tenVT' => $request->tenVT,
      'moTa' => $request->moTa,
    ]);

    $role->quyens()->sync($request->quyen_id);
    return redirect()->route('vaitros.index')->with('success', 'Cập nhật nhóm nhân viên thành công');
  }

  public function delete($vaiTro_id) {
    try {
      $this->vaitro->find($vaiTro_id)->delete();
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
