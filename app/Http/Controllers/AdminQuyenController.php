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

  public function index(Request $request)
  {
    $quyens = $this->quyen->where('parent_id', '!=', 0)->latest()->paginate(10);

    if(!empty($request->query('moTa'))) {
      $search = DB::table('quyens')->where('moTa','like','%'. $request->moTa .'%');
    }
    if(!empty($search)) {
      $quyens = $search->where('parent_id', '!=', 0)->paginate(10);
    }
    else {
      $quyens = DB::table('quyens')->orderBy('quyens.created_at', 'DESC')->where('parent_id', '!=', 0)->paginate(10);
    }
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
    $request->validate([
      'tenQuyen' => 'unique:quyens'
    ], [
      'tenQuyen.unique' => 'Mã quyền đã tồn tại',
    ]);
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
      'parent_id' => 40,
    ]);

    return redirect()->route('quyens.index')->with('success', 'Thêm mới quyền thành công');
  }

  public function edit($quyen_id)
  {
    $quyen = $this->quyen->find($quyen_id);
    $allQuyen = $this->quyen->all();
    return view('admin.quyen.edit', compact('quyen', 'allQuyen'));
  }

  public function update(Request $request, $quyen_id)
  {
    $quyenvali = $this->quyen->get();
    foreach($quyenvali as $item) {
      if($quyen_id != $item->quyen_id && $item->tenQuyen == $request->tenQuyen) {
        return back()->withInput()->with('error', 'Mã quyền đã tồn tại');
      }
    }

    $quyen = Quyen::where('tenQuyen', '=', $request->module_parent)->first();
    if ($quyen == null) {
      $quyen = Quyen::create([
        'tenQuyen' => $request->module_parent,
        'moTa' => $request->moTaModule,
        'parent_id' => 0,
      ]);
    }

    $quyenUpdate = $this->quyen->find($quyen_id);
    $quyenUpdate->update([
      'tenQuyen' => $request->tenQuyen,
      'moTa' => $request->moTa,
      'parent_id' => $quyen->quyen_id,
    ]);


    return redirect()->route('quyens.index')->with('success', 'Cập nhật quyền thành công');;
  }

  public function delete($quyen_id) {
    try {
      $this->quyen->find($quyen_id)->delete();
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
