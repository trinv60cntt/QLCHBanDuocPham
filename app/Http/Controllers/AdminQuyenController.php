<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaiTro;
use App\Models\Quyen;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;
use App\Components\QuyenRecursive;

class AdminQuyenController extends Controller
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
    $quyens = $this->quyen->latest()->paginate(10);
    return view('admin.quyen.index', compact('quyens'));
  }

  public function create()
  {
    $htmlOption = $this->getQuyen($parent_id = '');
    return view('admin.quyen.add', compact('htmlOption'));
  }

  public function getQuyen($parent_id)
  {
    $data = $this->quyen->all();
    $recursive = new QuyenRecursive($data);
    $htmlOption = $recursive->quyenRecursive($parent_id);
    return $htmlOption;
  }

  public function store(Request $request)
  {
    $quyen = Quyen::where('tenQuyen', '=', $request->module_parent)->first();
    if ($quyen == null) {
      $quyen = Quyen::create([
        'tenQuyen' => $request->module_parent,
        'moTa' => $request->moTaModule,
        'parent_id' => 0,
      ]);
    }

    Quyen::create([
      'tenQuyen' => $request->tenQuyen,
      'moTa' => $request->moTa,
      'parent_id' => $quyen->quyen_id,
    ]);

    return redirect()->route('quyens.index');
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
    $role = $this->vaitro->find($vaiTro_id);
    $role->update([
      'tenVT' => $request->tenVT,
      'moTa' => $request->moTa,
    ]);

    $role->quyens()->sync($request->quyen_id);
    return redirect()->route('vaitros.index');
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
